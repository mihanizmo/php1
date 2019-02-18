<?
include_once 'models/config.php';
?>

<!-- Страница с картинкой загруженного размера -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <a href="index.php">Вернуться в галерею</a>
    <div>
        <img src="<?=PHOTO_BIG.$_GET['photo'] ?>">
    </div>
</body>

</html>