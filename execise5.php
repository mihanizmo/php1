<h1>Первый вариант решения</h1>
<h2>$a = --$a;<br>
$b = ++$b;</h2>
<?php
$a = 2;
$b = 1;

$a = --$a;
$b = ++$b;

echo 'a = '.$a;
?>
<br>
<?php
echo 'b = '.$b;
?>

<br>
<h1>Второй вариант решения</h1>
<h2>$a = $a + $b;<br>
$b = $a - $b;<br>
$a = $a - $b;</h2>

<?php
$a = 2;
$b = 1;

$a = $a + $b;
$b = $a - $b;
$a = $a - $b;

echo 'a = '.$a;
?>
<br>
<?php
echo 'b = '.$b;
?>

