<?php

function sanitize_string($text)
{
    return htmlentities(filter_var(trim($text), FILTER_SANITIZE_STRING));
};
require('../connect.php');
if ($db->connect_error) {
    echo 'Ошибка - ' . $db->connect_error;
    exit();
} else {
    $tel = sanitize_string($_POST["tel"]);
    $password = md5(sanitize_string($_POST["password"]));

    if (strlen($tel) > 0 && strlen($password) > 0) {
        setcookie("uncorrect-auth", "", 0, '/');
        $result =  $db->query("SELECT * FROM `users` WHERE `tel` = '$tel' AND `password` = '$password'")->fetch_assoc();

        if (count($result) === 0) {
            setcookie("uncorrect-auth", "Не существует такого пользователя", time() + 60, '/');
            header("Location: ../");
        } else {
            setcookie("name", $result["name"], time() + (604800 * 4) * 12, '/');
            setcookie("id", $result["id"], time() + (604800 * 4) * 12, '/');

            setcookie("uncorrect-auth", "", 0, '/');

            $filename = "../pages/page".$result["id"].".php";
            $file = fopen($filename,"w");
            copy("../pages/example_page.php",$filename); 
            fclose($file);
            setcookie("page",$filename,time() + (604800 * 4) * 12,'/');
    
            header("Location: ../");
        }
    } else {
        setcookie("uncorrect-auth", "Некорректно введены данные", time() + 60, '/');
        header("Location: ../");
    }
}
$db->close();
