<?
include '../php/connect_db.php';

// Вывод товаров по шаблону
$sql_g = 'select * from goods';
$res_g = mysqli_query($connect, $sql_g);
$tpl_g = file_get_contents('../tpl/admin.tpl');
while ($data_g = mysqli_fetch_assoc($res_g)) {
    $id = $data_g['id'];
    $category_id = $data_g['category_id'];
    $img_admin = '<img src=../'.$data_g['dir'].'/'.$data_g['filename'].'>';
    $name_admin = $data_g['name'];
    
    $patterns_g = array('/{id}/', '/{category}/', '/{img_admin}/', '/{name_admin}/');
    $replace_g = array($id, $category_id, $img_admin, $name_admin);
    $admin .= preg_replace($patterns_g, $replace_g, $tpl_g);
}

// Вывод дополнительных (other) категорий начиная с 5го
$sql_c = 'select * from categories';
$res_c = mysqli_query($connect, $sql_c);
$tpl_c = file_get_contents('../tpl/category.tpl');
$i=1;
while ($data_c = mysqli_fetch_assoc($res_c)) {
    if ($i>4) {
        $id = $data_c['id'];
        $category = $data_c['category'];
        $patterns_c = array('/{id}/', '/{category}/');
        $replace_c = array($id, $category);
        $category_admin .= preg_replace($patterns_c, $replace_c, $tpl_c);
    }
    $i++;    
}

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
        <div class="admin">Administration panel:</div>
        <div class="admin_goods">Goods:</div>
        <a href="../new_goods.php"><button class="create_new_btn">Создать новый товар</button></a>
        <a href="../index.php"><button class="to_return_goods">Каталог товаров</button></a>
        <div class="wrap_admin">
            <?=$admin?>
        </div>
        <div class="admin_category">Other Category:</div>
        <div class="wrap_admin">
            <?=$category_admin?>
        </div>
        <div class="admin_category">Add Category:</div>
        <div class="wrap_admin">
            <div class="form_new_cat">
                <form action="../php/server_cat_new.php" method="POST">
                    <p>Добавить НОВУЮ категорию:</p>
                    <input class="category_new" type="text" name="category_new">
                    <div class="wrap_cat_btn">
                        <input type="submit" class="new_btn_category" value="Добавить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
