<?
include 'php/connect_db.php';
$sql = 'select g.*, c.category from goods g inner join categories c on g.category_id = c.id';
$res = mysqli_query($connect, $sql);

// Получение id при переходе с index.php
$id = $_GET['id'];

// Вывод данных из бд необходимого товара
while ($data = mysqli_fetch_assoc($res)) {
    if ($data['id'] == $id) {
        $category = $data['category'];
        $name_goods = $data['name'];
        $img_max = '<img src='.$data['dir_max'].'/'.$data['filename_max'].'>';
        $info_full = $data['info_full'];
        $price = $data['price'].'$';
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Guns Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <a href="feedback.php"><button class="feedback_btn">Оставить отзыв</button></a>
    <a href="index.php"><button class="to_return_goods">Каталог товаров</button></a>
    <div class="container">
        <div class="header">Guns Store</div>
        <div class="product">
            <div class="category_max">
                <?=$category?> :
            </div>
            <div class="name_goods_max">
                <?=$name_goods?>
            </div>
            <?=$img_max?>
            <div class="info_full">
                <?=$info_full?>
            </div>
            <div class="price_max">
                <?=$price?>
            </div>
            <div class="wrap_to_buy">
                <button class="to_buy">Сделать заказ</button>
            </div>
        </div>
    </div>
</body>

</html>
