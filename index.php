<?php
session_start();
require_once("blocks/head.php")
?>
<?php if ($_COOKIE["name"] == "" && $_COOKIE["id"] == "") : ?>
    <form action="validation/create_user.php" method="POST">
        <?php if ($_COOKIE["uncorrect-form"] != "") :
        ?>
            <p><?= $_COOKIE["uncorrect-form"] ?></p>
        <?php endif ?>
        <h2>Создать нового пользователя</h2>
        <input placeholder="Имя" name="name" type="text">
        <input placeholder="Телефон" name="tel" type="tel">
        <input placeholder="Пароль" name="password" type="password">
        <input type="submit">
    </form>

    <br>
    <br>
    <br>

    <form action="validation/auth.php" method="POST">
        <?php if ($_COOKIE["uncorrect-auth"] != "") :
        ?>
            <p><?= $_COOKIE["uncorrect-auth"] ?></p>
        <?php endif ?>
        <h2>Войти в свой аккаунт</h2>
        <input placeholder="Телефон" name="tel" type="tel">
        <input placeholder="Пароль" name="password" type="password">
        <input type="submit">
    </form>
<?php else : ?>

    <p> id = <?= $_COOKIE["id"] ?></p>
    <p> имя = <?= $_COOKIE["name"] ?></p>
    <br>
    <a href="<?= 'pages/page' . $_COOKIE["id"] . '.php' ?>">Ссылка на твою страницу</a>
    <br>
    <br>
    <form action="validation/search_users.php" method="POST">
        <?php if ($_COOKIE["uncorrect-name-of-user"] != "") :
        ?>
            <p><?= $_COOKIE["uncorrect-name-of-user"] ?></p>
        <?php endif ?>
        <input placeholder="Введите имя пользователя" name="name" type="text">
        <input type="submit">
    </form>
    <br>
    <br>

    <form action="validation/exit.php" method="post">
        <input type="submit" value="Выйти из аккаунта">
    </form>

    <br>
    <br>

    <?php if ($_SESSION["searched-users"] != "") :
        $users = $_SESSION["searched-users"];

        for ($i = 0; $i < count($users); $i++) {
            echo "<div class='searched-users' style='border:1px solid black; width:max-content;height:max-content;'>";
            echo "<p>" . $users[$i][0] . "</p>";
            echo "<p>" . $users[$i][3] . "</p>";
            echo "</div>";
            echo "<br>";
        }
        echo "<br>";
        echo "<br>"; 
        echo "<button>Убрать результаты поиска</button>"; 

    ?>
    
    <?php endif ?>

<?php endif ?>
<?php
require_once("blocks/foot.php")
?>