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
    $name = sanitize_string($_POST["name"]);
    $tel = sanitize_string($_POST["tel"]);
    $password = md5(sanitize_string($_POST["password"]));

    $id = rand(10000000000, 99999999999);

    $the_same_phones = $db->query("SELECT * FROM `users` WHERE `tel` = '$tel'");
    $users_with_the_sames_phones = $the_same_phones->fetch_all();

    if (count($users_with_the_sames_phones) > 0) {
        setcookie("uncorrect-form", "Пользователь с таким телефоном уже существует", time() + 60, '/');
        header("Location: ../");
    } else {
        if (strlen($name) > 0 && strlen($tel) > 0 && strlen($password) > 0) {
            setcookie("uncorrect-form", "", 0, '/');
            $db->query("INSERT INTO `users`(`name`,`tel`,`password`,`id`) VALUES ('$name','$tel','$password','$id')");
            setcookie("name", $name, time() + (604800 * 4) * 12, '/');
            setcookie("id", $id, time() + (604800 * 4) * 12, '/');
    
            $filename = "../pages/page" . $id . ".php";
            $file = fopen($filename, "w");
            copy("../pages/example_page.php", $filename);
            fclose($file);
            setcookie("page", $filename, time() + (604800 * 4) * 12, '/');
    
            header("Location: ../");
        } else {
            setcookie("uncorrect-form", "Некорректно введены данные", time() + 60, '/');
            header("Location: ../");
        }
    }
    
}
$db->close();
