<?
// Подключение файлов: конфигурации (config.php) и функций работы с картинками (photo.php)
include_once 'models/config.php';
include_once 'models/photo.php';
?>
<!-- Основная страница с галереей из наших уменьшенных картинок -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <!-- Блок с циклом в котором перебираются и показываются на страницу все маленькие картинки для дальнейшего вывода их в большом размере при клике -->
    <div class="img">
        <? for ($i=0; $i<count($images); $i++) : ?>
        <a href="image.php?photo=<?=$images[$i]?>">
            <img src="<?=PHOTO_SMALL.$images[$i]?>"> </a> <? endfor; ?>
    </div>
    <!-- Форма для загрузки картинки со странички -->
    <form class="form" action="" method="POST" enctype="multipart/form-data">
        <p>Загрузить картинку:</p>
        <input type="file" name="userfile"><br>
        <input type="submit" name="send" value="Загрузить">
        <span><?=$message?></span>
    </form>
</body>

</html>