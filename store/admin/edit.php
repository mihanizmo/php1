<?
// Подключение файлов
include '../php/connect_db.php';

// Прием данных
$id = $_POST['id'];
$category = $_POST['category'];

// Подключаем шаблон tpl
$tpl = file_get_contents('../tpl/edit.tpl');

// Построение данных из бд через шаблон
$sql = 'select g.*, c.category from goods g inner join categories c on g.category_id = c.id';
$res = mysqli_query($connect, $sql);
while ($data = mysqli_fetch_assoc($res)) {
    if ($data['id'] == $id) {
        
        // Для отправки по форме
        $filename = $data['filename'];
        $filename_max = $data['filename_max'];
        $name = $data['name'];
        $info_short = $data['info_short'];
        $info_full = $data['info_full'];
        $price = $data['price'];
        
        // Вставка на страницу
        $img_dir_filename = '<img src=../'.$data['dir'].'/'.$data['filename'].'>';
        $img_max_dir_filename = '<img src=../'.$data['dir_max'].'/'.$data['filename_max'].'>';
        
        // Вставка в шаблон
        $patterns = array('/{id}/', '/{filename}/', '/{filename_max}/', '/{img_dir_filename}/', '/{img_max_dir_filename}/', '/{name}/', '/{info_short}/', '/{info_full}/', '/{price}/', '/{category}/');
        $replace = array($id, $filename, $filename_max, $img_dir_filename, $img_max_dir_filename, $name, $info_short, $info_full, $price, $category);
        $edit .= preg_replace($patterns, $replace, $tpl);
    }
}

// Отдельное построение конструкции select для вывода категории из бд
$sql_category = 'select * from categories';
$res_category = mysqli_query($connect, $sql_category);
while ($data_category = mysqli_fetch_assoc($res_category)) {
    $category_res .= '<option';
    
    if ($data_category['id'] == $category) {
        $category_res .= ' selected>';
    } else {
        $category_res .= '>';
    }
    
    $category_res .= $data_category['category'].'</option>';
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
        <div class="admin">Edit panel:</div>
        <a href="../admin/admin.php"><button class="to_return_admin">Панель администрирования</button></a>
        <a href="../index.php"><button class="to_return_goods">Каталог товаров</button></a>
        <div class="edit_page">
            <?=$edit?>
            <select class="category_edit" name="category">
                <?=$category_res?>
            </select>
            <div class="wrap_info_btn">
                <input class="edit_btn" type="submit" value="Обновить всю информацию" name="info_btn">
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
