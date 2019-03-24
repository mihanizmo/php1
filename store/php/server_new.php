<?
include 'connect_db.php';

// Выход в панель администрирования
$exit = "Cейчас вы автоматически будете перенаправлены на страницу администрирования или нажмите кнопку:<br><meta http-equiv='refresh' content='30; URL = ../admin/admin.php'><a href='../admin/admin.php'><button>Панель администрирования</button></a>";

// Из файлов
$filename = $_FILES['img_new']['name'];
$filename_tmp = $_FILES['img_new']['tmp_name'];
$filename_max = $_FILES['img_max_new']['name'];
$filename_max_tmp = $_FILES['img_max_new']['tmp_name'];

// Из формы
$category = $_POST['category'];
//$category_new = $_POST['category_new'];
$name_new = $_POST['name_new'];
$info_short_new = $_POST['info_short_new'];
$info_full_new = $_POST['info_full_new'];
$price_new = $_POST['price_new'];

// Переменные
//$dir_new = 'goods/min/'.$category_new;
$dir = 'goods/min/'.$category;
$dir_max = 'goods/max';

// Определяем есть ли новые данные о новом товаре
if (($name_new) && ($info_short_new) && ($info_full_new) && ($price_new) && ($filename_tmp) && ($filename_max_tmp)) {

    // Перенос новой малой картинки в соответствующую папку / создание папки
    if (is_dir('../'.$dir)) {
        if (move_uploaded_file($filename_tmp, '../'.$dir.'/'.$filename)) {
        echo "Успешное добавление новой малой картинки!<br>";
        } else {
            echo "Ошибка при добавлении новой малой картинки либо она не загружалась.<br>";
        }
    } else {
        if (mkdir('../'.$dir)) {
            if (move_uploaded_file($filename_tmp, '../'.$dir.'/'.$filename)) {
                echo "Успешное добавление новой малой картинки!<br>";
            } else {
                echo "Ошибка при добавлении новой малой картинки либо она не загружалась.<br>";
            }
        }
    }

    // Переносим новую большую картинку в папку
    if (move_uploaded_file($filename_max_tmp, '../'.$dir_max.'/'.$filename_max)) {
            echo "Успешное добавление новой большой картинки!<br>";
        } else {
            echo "Ошибка при добавлении новой большой картинки либо она не загружалась.<br>";
        }

    // Определяем id категории
    $sql_cat = 'select * from categories';
    $cat_res = mysqli_query($connect, $sql_cat);
    while ($data_cat = mysqli_fetch_assoc($cat_res)) {
            if ($data_cat['category'] == $category) {
                $cat_id = $data_cat['id'];
            }
    }

    // Добавление нового товара в бд
    $sql_new = "insert into goods (filename, filename_max, name, info_short, info_full, price, dir, dir_max, category_id) values ('$filename', '$filename_max', '$name_new', '$info_short_new', '$info_full_new', '$price_new', '$dir', '$dir_max', '$cat_id')";
    if (mysqli_query($connect, $sql_new)) {
        echo "Успешное добавление информации о новом товаре!<br>";
        echo $exit;
    } else {
        echo "Ошибка при добавлении информации о новом товаре.<br>";
        echo $exit;
        }
} else {
    echo "Новых данных о новом товаре нет или их недостаточно, заполните пожалуйста все сведенья о новом товаре:<br>1) Прикрепите большую и маленькую картинку<br>2) Заполните имя нового товара<br>3) Заполните короткое и полное описание нового товара<br>4) Заполните цену нового товара<br>5) Выберите правильно категорию (если ее нет - сперва создайте в панели администрирования)<br>";
    echo $exit;
}