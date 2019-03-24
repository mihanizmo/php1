<?
include 'connect_db.php';

// Прием данных из формы
$id = $_POST['id'];
$filename = $_POST['filename'];
$filename_max = $_POST['filename_max'];
$name = $_POST['name'];
$info_short = $_POST['info_short'];
$info_full = $_POST['info_full'];
$price = $_POST['price'];
$category = $_POST['category'];

// Прием данных из загруженных файлов
$file_name_temp = $_FILES['img_file']['tmp_name'];
$file_name = $_FILES['img_file']['name'];
$file_max_name_temp = $_FILES['img_max_file']['tmp_name'];
$file_max_name = $_FILES['img_max_file']['name'];

// Переменные
$dir_name_new = "../goods/min/".$category."/".$file_name;
$dir_name_max_new = "../goods/max/".$file_max_name;
$dir_new = "../goods/min/".$category;
$dir_max_new = "../goods/max/";


// Начало вывода данных на страницу
echo 'Ознакомьтесь с результатами :<br>';

// Есть ли новая малая картинка? Если есть - старую переносим в корзину
if ($file_name_temp) {
    
    $sql_img_old = 'select * from goods';
    $res_img_old = mysqli_query($connect, $sql_img_old);
    while ($data_img_old = mysqli_fetch_assoc($res_img_old)) {
        if ($data_img_old['id'] == $id) {
            $dir_name_old = '../'.$data_img_old['dir'].'/'.$data_img_old['filename'];
            if (file_exists($dir_name_old)) {
                $dir_name_recycle = '../goods/recycle/'.$data_img_old['filename'];
                if (rename($dir_name_old, $dir_name_recycle)) {
                   echo 'Успешное перемещение старой малой картинки в корзину!<br>';
                } else {
                    echo 'Ошибка при перемещении старой малой картинки в корзину.<br>';
                }
            } else {
                echo 'Cтарая малая картинка не найдена.<br>';
            }
        }
    }
}

// Есть ли новая большая картинка? Если есть - старую переносим в корзину
if ($file_max_name_temp) {
    
    $sql_img_old = 'select * from goods';
    $res_img_old = mysqli_query($connect, $sql_img_old);
    while ($data_img_old = mysqli_fetch_assoc($res_img_old)) {
        if ($data_img_old['id'] == $id) {
            $dir_name_old = '../'.$data_img_old['dir_max'].'/'.$data_img_old['filename_max'];
            if (file_exists($dir_name_old)) {
                $dir_name_recycle = '../goods/recycle/'.$data_img_old['filename_max'];
                if (rename($dir_name_old, $dir_name_recycle)) {
                   echo 'Успешное перемещение старой большой картинки в корзину!<br>';
                } else {
                    echo 'Ошибка при перемещении старой большой картинки в корзину.<br>';
                }
            } else {
                echo 'Cтарая большая картинка не найдена.<br>';
            }
        }
    }
}

// Загрузка малой картинки если она есть / проверка папки - создание, перемещение файла, запись в бд
if ($file_name_temp) {

    if (is_dir('../goods/min/'.$category)) {
        if (move_uploaded_file($file_name_temp, $dir_new.'/'.$file_name)) {
            $sql_img = "update goods set filename = '".$file_name."' where id = '".$id."'";
            if (mysqli_query($connect, $sql_img)) {
                echo "Успешная загрузка малой картинки!<br>";
            } else {
                echo "Ошибка при загрузке малой картинки в базу.<br>";
            }
        } else {
            echo "Ошибка при добавлении картинки или она не загружалась.<br>";
        }

    } else {
        if (mkdir('../goods/min/'.$category)) {
            if (move_uploaded_file($file_name_temp, $dir_new.'/'.$file_name)) {
                $sql_img = "update goods set filename = '".$file_name."' where id = '".$id."'";
                if (mysqli_query($connect, $sql_img)) {
                    echo "Успешная загрузка малой картинки!<br>";
                } else {
                    echo "Ошибка при загрузке малой картинки в базу.<br>";
                }
            } else {
                echo "Ошибка при добавлении маленькой картинки.<br>";
            }
        } else {
            echo "Ошибка при создании директории.<br>";
        }      
    }
} else {
    echo "Малая картинка не загружалась.<br>";
}

// Загрузка большой картинки если она есть / перемещение файла, запись в бд
if ($file_max_name_temp) {
    
    if (move_uploaded_file($file_max_name_temp, $dir_max_new.'/'.$file_max_name)) {
        
        $sql_img = "update goods set filename_max = '".$file_max_name."' where id = '".$id."'";
        if (mysqli_query($connect, $sql_img)) {
            echo "Успешная загрузка большой картинки!<br>";
        } else {
            echo "Ошибка при загрузке большой картинки в базу.<br>";
        }
    } else {
        echo "Ошибка при добавлении большой картинки.<br>";
    }
    
} else {
    echo "Большая картинка не загружалась.<br>";
}

// Обновление имени / если новое то перезаписывается
$sql_name = 'select * from goods';
$res_name = mysqli_query($connect, $sql_name);
while ($data_name = mysqli_fetch_assoc($res_name)) {
    if ($id == $data_name['id']) {
       if ($data_name['name'] <> $name) {
           $sql_name_edit = "update goods set name = '".$name."' where id = '".$id."'";
           if (mysqli_query($connect, $sql_name_edit)) {
               echo "Успешное обновление имени!<br>";
           } else {
               echo "Ошибка при обновлении имени.<br>";
           }
       } else {
           echo "Имя осталось без изменений.<br>";
       }
    }
}

// Обновление короткого описания / если новое то перезаписывается
$sql_short = 'select * from goods';
$res_short = mysqli_query($connect, $sql_short);
while ($data_short = mysqli_fetch_assoc($res_short)) {
    if ($id == $data_short['id']) {
       if ($data_short['info_short'] <> $info_short) {
           $sql_short_edit = "update goods set info_short = '".$info_short."' where id = '".$id."'";
           if (mysqli_query($connect, $sql_short_edit)) {
               echo "Успешное обновление короткого описания!<br>";
           } else {
               echo "Ошибка при обновлении короткого описания.<br>";
           }
       } else {
           echo "Короткое описание осталось без изменений.<br>";
       }
    }
}

// Обновление полного описания / если новое то перезаписывается
$sql_full = 'select * from goods';
$res_full = mysqli_query($connect, $sql_full);
while ($data_full = mysqli_fetch_assoc($res_full)) {
    if ($id == $data_full['id']) {
       if ($data_full['info_full'] <> $info_full) {
           $sql_full_edit = "update goods set info_full = '".$info_full."' where id = '".$id."'";
           if (mysqli_query($connect, $sql_full_edit)) {
               echo "Успешное обновление полного описания!<br>";
           } else {
               echo "Ошибка при обновлении полного описания.<br>";
           }
       } else {
           echo "Полное описание осталось без изменений.<br>";
       }
    }
}

// Обновление цены / если новая то перезаписывается
$sql_price = 'select * from goods';
$res_price = mysqli_query($connect, $sql_price);
while ($data_price = mysqli_fetch_assoc($res_price)) {
    if ($id == $data_price['id']) {
       if ($data_price['price'] <> $price) {
           $sql_price_edit = "update goods set price = '".$price."' where id = '".$id."'";
           if (mysqli_query($connect, $sql_price_edit)) {
               echo "Успешное обновление цены!<br>";
           } else {
               echo "Ошибка при обновлении цены.<br>";
           }
       } else {
           echo "Цена осталась без изменений.<br>";
       }
    }
}

// Обновление категории
    // Поиск id новой категории
$sql_cat = 'select * from categories';
$res_cat = mysqli_query($connect, $sql_cat);
while ($data_cat = mysqli_fetch_assoc($res_cat)) {
    if ($category == $data_cat['category']) {
        $new_id_cat = $data_cat['id'];
    }
}

// Изменение категории
$sql_cat = 'select g.*, c.category from goods g inner join categories c on g.category_id = c.id';
$res_cat = mysqli_query($connect, $sql_cat);
while ($data_cat = mysqli_fetch_assoc($res_cat)) {
    if ($id == $data_cat['id']) {
       if ($data_cat['category_id'] <> $new_id_cat) {
           $sql_cat_edit = "update goods set category_id = '".$new_id_cat."' where id = '".$id."'";
           if (mysqli_query($connect, $sql_cat_edit)) {
               echo "Успешное обновление категории!<br>";
               
               // Перенос малой картинки в новую папку новой категории
               $dir_name_in = '../'.$data_cat['dir'].'/'.$data_cat['filename'];
               $dir_name_out = '../goods/min/'.$category.'/'.$data_cat['filename'];
               if (rename($dir_name_in, $dir_name_out)) {
                   echo "Успешное перемещение малой картинки в новую категорию-директорию!<br>";
               } else {
                   echo "Ошибка перемещения малой картинки в новую категорию-директорию.<br>";
               }
               
               // Запись в бд о новом расположении малой картинки
               $dir_new = 'goods/min/'.$category;
               $sql_dir_new = "update goods set dir = '".$dir_new."' where id = '".$id."'";
               if (mysqli_query($connect, $sql_dir_new)) {
                   echo 'Новая директория успешно изменена в базе!<br>';
               } else {
                   echo 'Ошибка при изменении директории в базе.<br>';
               }
                   
           } else {
               echo "Ошибка при обновлении категории.<br>";
           }
       } else {
           echo "Категория осталась без изменений.<br>";
       }
    }
}

// Переход на другую страницу
echo "Cейчас вы автоматически будете перенаправлены на страницу администрирования или нажмите кнопку:<br>";
echo "<meta http-equiv='refresh' content='30; URL = ../admin/admin.php'>";
echo '<a href="../admin/admin.php"><button>Панель администрирования</button></a>';
