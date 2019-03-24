<?
$server = "localhost";
$user = "root";
$pass = "";
$db = "store";
$connect = mysqli_connect($server, $user, $pass, $db);

if (!$connect) {
      die ("Соединение с базой данных не установлено.");
}