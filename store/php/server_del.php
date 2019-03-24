<?
include 'connect_db.php';

$id_del = $_POST['id'];

// Удаляем запись о товаре из бд
$sql = 'select g.*, c.category from goods g inner join categories c on g.category_id = c.id';
$res = mysqli_query($connect, $sql);
while ($data = mysqli_fetch_assoc($res)) {
    if ($data['id'] == $id_del) {
        $sql_del = "delete from goods where id = '$id_del'";
        if (mysqli_query($connect, $sql_del)) {
            
            // Перемещаем малую картинку в корзину если она есть
            $sql_img_old = 'select * from goods';
            $res_img_old = mysqli_query($connect, $sql_img_old);
            $dir_name_old = '../'.$data['dir'].'/'.$data['filename'];
            if (file_exists($dir_name_old)) {
                $dir_name_recycle = '../goods/recycle/'.$data['filename'];
                if (rename($dir_name_old, $dir_name_recycle)) {
                   echo 'Успешное перемещение старой малой картинки в корзину!<br>';
                } else {
                    echo 'Ошибка при перемещении старой малой картинки в корзину.<br>';
                }
            } else {
                echo 'Малая картинка не найдена.<br>';
            }
            
            // Перемещаем большую картинку в корзину если она есть
            $sql_img_old = 'select * from goods';
            $res_img_old = mysqli_query($connect, $sql_img_old);
            $dir_name_old = '../'.$data['dir_max'].'/'.$data['filename_max'];
            if (file_exists($dir_name_old)) {
                $dir_name_recycle = '../goods/recycle/'.$data['filename_max'];
                if (rename($dir_name_old, $dir_name_recycle)) {
                   echo 'Успешное перемещение старой большой картинки в корзину!<br>';
                } else {
                    echo 'Ошибка при перемещении старой большой картинки в корзину.<br>';
                }
            } else {
                echo 'Большая картинка не найдена.<br>';
            }
            
            echo "Товар успешно удален!<br>";
        } else {
            echo "Ошибка при удалении товара.<br>";
        }
    }
}

// Переход на другую страницу
echo "Cейчас вы автоматически будете перенаправлены на страницу администрирования или нажмите кнопку:<br>";
echo "<meta http-equiv='refresh' content='15; URL = ../admin/admin.php'>";
echo '<a href="../admin/admin.php"><button>Панель администрирования</button></a>';