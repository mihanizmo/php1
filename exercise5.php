<?
// Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.

function translateProbel($text) {
    $change = [' ' => '_'];
    return strtr($text, $change);
}

echo translateProbel('Михаил коров доил');
