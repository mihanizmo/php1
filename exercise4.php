<?
// Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).

function mathOperation($arg1, $arg2, $operation) {
    switch($operation) {
            
        case ('Сложение'):
            return $arg1 + $arg2;
            break;
            
        case ('Вычитание'):
            return $arg1 - $arg2;
            break;
            
        case ('Умножение'):
            return $arg1 * $arg2;
            break;
            
        case ('Деление'):
            if ($arg2 == 0) {
                echo 'На ноль делить нельзя!';
                break;
            }
            return $arg1 / $arg2;
            break;
            
        default:
            die ('Некорректный ввод данных!');
        }       
    }
    
echo $result = mathOperation(rand(-100, 100), rand(-100, 100), 'Умножение');