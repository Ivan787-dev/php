
<p> id = <?= $_COOKIE["id"]?></p>
<p> имя = <?= $_COOKIE["name"]?></p>
<br>
<a href="<?= $_COOKIE["page"]?>">Ссылка на твою страницу</a>
<br>

<form action="../validation/exit.php" method="POST">
    <input type="submit" value="Выйти из аккаунта">
</form>
