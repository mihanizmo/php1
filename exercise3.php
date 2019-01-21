<?
// Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
function fSum($x, $y) {
    $sum = $x + $y;
    return $sum;
}

function fRaz($x, $y) {
    $raz = $x - $y;
    return $raz;
}

function fPro($x, $y) {
    $pro = $x * $y;
    return $pro;
}

function fDel($x, $y) {
    $del = $x / $y;
    return $del;
}

echo 'Сумма двух случайных чисел = '.fSum(rand(-100, 100), rand(-100, 100)).'<br>';
echo 'Разность двух случайных чисел = '.fRaz(rand(-100, 100), rand(-100, 100)).'<br>';
echo 'Произведение двух случайных чисел = '.fPro(rand(-100, 100), rand(-100, 100)).'<br>';
echo 'Частное двух случайных чисел = '.fDel(rand(-100, 100), rand(-100, 100));