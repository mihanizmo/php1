<?
$server = "localhost";
$user = "root";
$pass = "";
$db = "gallery";

$sql_connect = mysqli_connect($server, $user, $pass, $db);

if (!$sql_connect) {
    echo "Ошибка: Невозможно установить соединение с сервером";
}