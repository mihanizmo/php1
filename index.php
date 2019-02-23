<?
include 'models/sql_connect.php';

// Запрос к базе, таблицы images, вывод по количеству просмотров, от большего к меньшему
$sql_res = mysqli_query($sql_connect, 'select * from images order by views DESC');

$div = '<div>';

// Циклом выводим все маленькие картинки: с названием файла без расширения, размером, делаем ссылку на страницу с большой картинкой
while ($data = mysqli_fetch_assoc($sql_res)) {
    $name_img = explode('.', $data['name']);
    $div .= $name_img[0].'<a href="image.php?id='.$data['id'].'"><br><img src='.$data['path'].$data['name'].'></a><br>'.$data['size'].'<br>';
}
$div .= '</div>';

echo $div;