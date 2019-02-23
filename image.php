<?
include 'models/sql_connect.php';

// Запрос к базе, к таблице images
$sql_res = mysqli_query($sql_connect, 'select * from images');

$id = $_GET['id'];

// Подставляем путь к большой картинке по id, через цикл
while ($data = mysqli_fetch_assoc($sql_res)) {
    if ($data['id'] == $id) {
        
        // Составляем путь к большой картинке
        $fullimage = ($data['path_big'].$data['name']);
        
        // Записываем в базу +1 к просмотру
        mysqli_query($sql_connect, "update images set views=views+1 where id=$id");
        
        // Выводим на странице +1 к просмотру
        $views = ($data['views']+1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>image</title>
</head>

<body>
    <a href="index.php">Вернуться в галерею</a>
    <div>
        <img src="<?=$fullimage?>"><br>
        <p>Число просмотров картинки: <?=$views?></p>
    </div>
</body>

</html>
