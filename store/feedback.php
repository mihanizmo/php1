<?
include 'php/connect_db.php';

// Capcha на отправку
$x = rand(1,10);
$y = rand(1,10);
$res = $x * $y;

// Вывод отзывов через шаблон
$sql = 'select * from feedback group by date_create desc';
$res_sql = mysqli_query($connect, $sql);
$tpl = file_get_contents('tpl/feedback.tpl');

while ($data = mysqli_fetch_assoc($res_sql)) {
    $name = $data['name'];
    $date_birthday = $data['date_birthday'];
    $feedback_info = $data['feedback_info'];
    $rating = $data['rating'];
    $date_create = $data['date_create'];
    
    $patterns = array('/{name}/', '/{date_birthday}/', '/{feedback_info}/', '/{rating}/', '/{date_create}/');
    $replace = array($name, $date_birthday, $feedback_info, $rating, $date_create);
    $feedback .= preg_replace($patterns, $replace, $tpl);      
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Guns Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <div class="header">Guns Store</div>
        <div class="feedback">Your feedback:</div>
        <a href="index.php"><button class="to_return_fb">Каталог товаров</button></a>
        <div class="feedback_page">
            <form class="" action="php/server_feedback.php" method="POST">
                <input type="hidden" name="res" value="<?=$res?>">
                <p>Имя:<span class="red">*</span></p>
                <input class="name" type="text" name="name">
                <p>Дата рождения:</p>
                <input type="date" name="date_birthday"><br>
                <p>Отзыв:<span class="red">*</span></p>
                <textarea class="feedback_info" name="feedback_info"></textarea>
                <p>Оценка сайта:</p>
                <input type="radio" name="rating" value="Так себе"> Так себе<br>
                <input type="radio" name="rating" value="Нормально"> Нормально<br>
                <input type="radio" name="rating" value="Отлично"> Отлично<br>
                <p>Проверка что вы не робот, напишите ответ
                    <?=$x?> *
                    <?=$y?>= :<span class="red">*</span></p>
                <input class="answer" type="number" name="answer">
                <div class="field"><span class="red">*</span> - обязательные поля для заполнения.</div>
                <div class="wrap_to_feedback">
                    <input type="submit" value="Отправить отзыв">
                </div>
            </form>
        </div>
        <div class="feedback_all">
           <div class="feedback">Visitors feedback:</div>
            <?=$feedback?>
        </div>
    </div>
</body>

</html>
