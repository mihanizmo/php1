<?
include 'php/connect_db.php';

// Отдельное построение конструкции select для вывода категории товара из бд
$sql_category = 'select * from categories';
$res_category = mysqli_query($connect, $sql_category);
while ($data_category = mysqli_fetch_assoc($res_category)) {
    $category .= '<option>'.$data_category['category'].'</option>';
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Guns Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <a href="index.php"><button class="to_return_goods_up">Каталог товаров</button></a>
    <a href="admin/admin.php"><button class="admin_btn">Панель администрирования</button></a>
    <div class="container">
        <div class="header">Guns Store</div>
        <div class="new_goods">Create new goods:</div>
        <div class="new">
            <form action="php/server_new.php" method="POST" enctype="multipart/form-data">
                <div class="file_center">
                    <p>Выберите новую МАЛУЮ картинку:<br>Рекомендуемое разрешение 512х384 !</p>
                    <input type="file" name="img_new" accept="image/*">
                    <p>Выберите новую БОЛЬШУЮ картинку:<br>Рекомендуемое разрешение 1920х1080 !</p>
                    <input type="file" name="img_max_new" accept="image/*">
                </div>
                <p>Имя нового товара:</p>
                <input class="name_new" type="text" name="name_new">
                <p>Короткое описание нового товара:</p>
                <textarea class="info_short_new" name="info_short_new"></textarea>
                <p>Полное описание нового товара:</p>
                <textarea class="info_full_new" name="info_full_new"></textarea>
                <p>Цена нового товара:</p>
                <input class="price_new" type="text" name="price_new">
                <p>Категория нового товара:</p>
                <select class="category_old" name="category">
                    <?=$category?>
                </select>
                <div class="wrap_new_btn">
                    <input class="new_btn" type="submit" value="Добавить новые данные" name="new_btn">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
