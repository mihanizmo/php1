<?
// С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.

function power($val, $pow) {
    if ($pow < 0) {
        return power(1/$val, -$pow);
    }
    
    if ($pow == 0) {
        return 1;
    }
    
    if ($pow == 1) {
        return $val;
    }
    
    return $val * power($val, $pow-1);
}

echo power(7, -2);