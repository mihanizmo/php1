<?
$number1 = $_POST['number1'];
$number2 = $_POST['number2'];
$operation = $_POST['operation'];

if ($operation == "+") {
    $res = $number1 + $number2;
} elseif ($operation == "-") {
    $res = $number1 - $number2;
} elseif ($operation == "*") {
    $res = $number1 * $number2;
} elseif ($operation == "/") {
    if ($number2 == 0) {
        $res = "На 0 делить нельзя!";
    } else {
        $res = $number1 / $number2;
    }
}
?>

<div style="width: 1200px; margin: 0 auto">
    <h2>Калькулятор:</h2>
    <form action="#" method="POST">
        <input type="number" style="width: 50" name="number1">
        <input type="number" style="width: 50" name="number2">
        <input type="submit" name="operation" value="+">
        <input type="submit" name="operation" value="-">
        <input type="submit" name="operation" value="*">
        <input type="submit" name="operation" value="/">
        <h2>Результат:</h2>
        <h2><?=$res?></h2>
    </form>
</div>
