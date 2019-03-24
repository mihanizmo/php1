<?
$id_del = $_POST['id'];
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Guns Store</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <div class="header">Guns Store</div>
        <div class="admin">Confirm:</div>
        <div class="confirm">
            <p>Вы действительно хотите удалить категорию безвозвратно !?</p>
            <form class="confirm_form" action="server_del_cat.php" method="POST">
                <input type="hidden" name="id" value="<?=$id_del?>">
                <input type="submit" class="confirm_yes" value="Да">
            </form>
            <a href="../admin/admin.php"><button class="confirm_no">Нет</button></a>
        </div>
    </div>
</body>

</html>
