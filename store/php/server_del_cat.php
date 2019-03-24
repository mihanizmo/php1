<?
include 'connect_db.php';

$id_del = $_POST['id'];

$sql = "select * from categories";
$res = mysqli_query($connect, $sql);
while ($data = mysqli_fetch_assoc($res)) {
    if ($data['id'] == $id_del) {
        $dir = "../goods/min/".$data['category'];
        
        $sql_del = "delete from categories where id = '$id_del'";
        if (mysqli_query($connect, $sql_del)) {
            
            // Удаление пустой папки категории малых картинок
            if (rmdir($dir)) {
                echo "Папка категории успешно удалена!<br>";
            } else {
                echo "Ошибка при удалении категории папки<br>";
            }
            
            echo "Категория успешно удалена!<br>";
        } else {
            echo "Ошибка при удалении категории, либо есть как минимум 1 товар с этой категорией, сначала удалите все товары данной категорией, потом еще раз попробуйте удалить данную категорию.<br>";
        }
    }
}

// Переход на другую страницу
echo "Cейчас вы автоматически будете перенаправлены на страницу администрирования или нажмите кнопку:<br>";
echo "<meta http-equiv='refresh' content='15; URL = ../admin/admin.php'>";
echo '<a href="../admin/admin.php"><button>Панель администрирования</button></a>';