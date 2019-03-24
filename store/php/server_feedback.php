<?
include 'connect_db.php';

// Выход на страницу отзывов
$exit = "Cейчас вы автоматически будете перенаправлены на страницу для отзывов или нажмите кнопку:<br><meta http-equiv='refresh' content='15; URL = ../feedback.php'><a href='../feedback.php'><button>Страница отзывов</button></a>";

// Прием данных из формы 
$res = $_POST['res'];
$answer = $_POST['answer'];
$name_raw = $_POST['name'];
$date_birthday = $_POST['date_birthday'];
$feedback_info_raw = $_POST['feedback_info'];
$rating = $_POST['rating'];

// Проверка имени на инъекции тегов
$name_go = ($name_raw) ? strip_tags($name_raw) : "";

// Проверка отзыва на инъекции тегов
$feedback_info = ($feedback_info_raw) ? strip_tags($feedback_info_raw) : "";

// Проверка заполнения формы отзыва и добавления его в бд
$sql_save = "insert into feedback (name, date_birthday, feedback_info, rating) values ('$name', '$date_birthday', '$feedback_info', '$rating')";
if (($res == $answer) && ($feedback_info)) {    
    if (mysqli_query($connect, $sql_save)) {
        echo "Спасибо за отзыв! :)<br>";
        echo $exit;
    } else {
        echo "Ошибка записи данных.<br>";
        echo $exit;
    }
} else {
    echo "Не верный ответ на вопрос или не заполнено поле 'Отзыв', повторите пожалуйста ввод данных :(<br>";
    echo $exit;
}