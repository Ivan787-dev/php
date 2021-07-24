<?php
session_start();
 function sanitize_string($text)
{
    return htmlentities(filter_var(trim($text), FILTER_SANITIZE_STRING));
}
require("../connect.php");

if ($db->connect_errno) {
    echo "Ошибка - " . $db->connect_error;
    exit();
} else {
    $name = sanitize_string($_POST["name"]);

    $searched_users = $db->query("SELECT * FROM `users` WHERE `name` = '$name'")->fetch_all();
    if (count($searched_users) > 0) {
        $_SESSION["searched-users"] = $searched_users;
        setcookie("uncorrect-name-of-user", "", 0, '/');
        header("Location: ../"); 
    } else {
        setcookie("uncorrect-name-of-user", "Такого пользователя не найдено", time() + 60, '/');
        header("Location: ../");
    }
}
