<?
// Соединение с бд
include 'php/connect_db.php';

// Запрос в бд
$sql = 'select g.*, c.category from goods g inner join categories c on g.category_id = c.id';
$res = mysqli_query($connect, $sql);

// Шаблон
$tpl = file_get_contents('tpl/guns.tpl');

// Вывод товаров из бд с помощью цикла и шаблона
while ($data = mysqli_fetch_assoc($res)) {
    if ($data['category'] == 'pistols') {
        $id = $data['id'];
        $name_goods = $data['name'];
        $img_small = '<img src='.$data['dir'].'/'.$data['filename'].'>';
        $price = $data['price'].'$';
        $info_short = $data['info_short'];
    
        $patterns = array('/{id}/', '/{name_goods}/', '/{img_small}/', '/{price}/', '/{info_short}/', '/{category_other}/', '/{other}/');
        $replace = array($id, $name_goods, $img_small, $price, $info_short, $category_other, $other);
        $pistols .= preg_replace($patterns, $replace, $tpl);
    }
    
    if ($data['category'] == 'smgs') {
        $id = $data['id'];
        $name_goods = $data['name'];
        $img_small = '<img src='.$data['dir'].'/'.$data['filename'].'>';
        $price = $data['price'].'$';
        $info_short = $data['info_short'];
    
        $patterns = array('/{id}/', '/{name_goods}/', '/{img_small}/', '/{price}/', '/{info_short}/', '/{category_other}/', '/{other}/');
        $replace = array($id, $name_goods, $img_small, $price, $info_short, $category_other, $other);
        $smgs .= preg_replace($patterns, $replace, $tpl);
    }
    
    if ($data['category'] == 'rifles') {
        $id = $data['id'];
        $name_goods = $data['name'];
        $img_small = '<img src='.$data['dir'].'/'.$data['filename'].'>';
        $price = $data['price'].'$';
        $info_short = $data['info_short'];
    
        $patterns = array('/{id}/', '/{name_goods}/', '/{img_small}/', '/{price}/', '/{info_short}/', '/{category_other}/', '/{other}/');
        $replace = array($id, $name_goods, $img_small, $price, $info_short, $category_other, $other);
        $rifles .= preg_replace($patterns, $replace, $tpl);
    }
    
    if ($data['category'] == 'heavy') {
        $id = $data['id'];
        $name_goods = $data['name'];
        $img_small = '<img src='.$data['dir'].'/'.$data['filename'].'>';
        $price = $data['price'].'$';
        $info_short = $data['info_short'];
        
        $patterns = array('/{id}/', '/{name_goods}/', '/{img_small}/', '/{price}/', '/{info_short}/', '/{category_other}/', '/{other}/');
        $replace = array($id, $name_goods, $img_small, $price, $info_short, $category_other, $other);
        $heavy .= preg_replace($patterns, $replace, $tpl);
    }
    
    if (($data['category'] != 'pistols') && ($data['category'] != 'smgs') && ($data['category'] != 'rifles') && ($data['category'] != 'heavy')) {
        $id = $data['id'];
        $name_goods = $data['name'];
        $img_small = '<img src='.$data['dir'].'/'.$data['filename'].'>';
        $price = $data['price'].'$';
        $info_short = $data['info_short'];
        
        $category_other = "<div class='category_other'>Other Category: ".$data['category']."</div>";
        $category_name = "<div class='category'>Other:</div>";
        $other = "_other";
    
        $patterns = array('/{id}/', '/{name_goods}/', '/{img_small}/', '/{price}/', '/{info_short}/', '/{category_other}/', '/{other}/');
        $replace = array($id, $name_goods, $img_small, $price, $info_short, $category_other, $other);
        $category_unit .= preg_replace($patterns, $replace, $tpl);
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
    <a href="admin/admin.php"><button class="admin_btn">Панель администрирования</button></a>
    <div class="container">
        <div class="header">Guns Store</div>
        <div class="category">Pistols:</div>
        <div class="pistols">
            <?=$pistols?>
        </div>
        <div class="category">SMGs:</div>
        <div class="smgs">
            <?=$smgs?>
        </div>
        <div class="category">Rifles:</div>
        <div class="rifles">
            <?=$rifles?>
        </div>
        <div class="category">Heavy:</div>
        <div class="heavy">
            <?=$heavy?>
        </div>
        <?=$category_name?>
        <div class="heavy">
            <?=$category_unit?>
        </div>
    </div>
</body>

</html>
