<?
include 'connect_db.php';

// Выход в панель администрирования
$exit = "Cейчас вы автоматически будете перенаправлены на страницу администрирования или нажмите кнопку:<br><meta http-equiv='refresh' content='15; URL = ../admin/admin.php'><a href='../admin/admin.php'><button>Панель администрирования</button></a>";

// Из формы
$category_new_raw = $_POST['category_new'];

// Проверка на инъекции тегов
$category_new_go = ($category_new_raw) ? strip_tags($category_new_raw) : "";

// Проверка чтобы не было пробелов и лишнего, только цифры и латинские буквы
if (ctype_alnum($category_new_go) == false) {
    echo "Недопустимые символы или пробелы, название должно быть из цифр и латинских букв, проверьте вводимые данные.<br>";
    echo $exit;
    exit;
}

// Переменные
$category_new_min = mb_strtolower($category_new_go);
$dir = 'goods/min/'.$category_new_min;

// Есть новая категория?
if ($category_new_go) {
    
    // Исключаем дублирование категории
    $sql_cat = 'select * from categories';
    $cat_res = mysqli_query($connect, $sql_cat);
    while ($data_cat = mysqli_fetch_assoc($cat_res)) {
        $data_cat_min = mb_strtolower($data_cat['category']);
        if ($category_new_min == $data_cat_min) {
            echo "Категория с таким именем присутствует в базе, попробуйте другое имя для категории.<br>";
            echo $exit;
            exit;
        }
    }
    
    // Добавление новой категории в бд
    $sql_cat_add = "insert into categories (category) values ('$category_new_min')";
    if (mysqli_query($connect, $sql_cat_add)) {
        echo "Успешное добавление новой категории!<br>";
        
        // Cоздание папки малых картинок если ее нет
        if (is_dir('../'.$dir)) {
            echo "Папка для новой малой картинки присутствует.<br>";
        } else {
            if (mkdir('../'.$dir)) {
                echo "Успешное добавление новой папки для малой картинки!<br>";
            } else {
                echo "Ошибка при добавлении новой папки для малой картинки.<br>";
            }
        }       
              
        echo $exit;
    } else {
        echo "Ошибка при добавлении новой категории.<br>";
        echo $exit;
    }
} else {
    echo "Поле для новой категории не заполнено.<br>";
    echo $exit;
}