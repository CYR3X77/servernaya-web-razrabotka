<?php
declare(strict_types=1);

$a = 27; $b = 12;
$hypotenuse = sqrt($a**2 + $b**2);
echo round($hypotenuse, 2) . "
";

$a = 27; $b = 12;
$other_cathetus = sqrt($a**2 - $b**2);
echo round($other_cathetus, 2) . "
";

$a = 27; $b = 23;
$other_cat = sqrt($a**2 - $b**2);
$angle1 = rad2deg(asin($b / $a));
$angle2 = 90 - $angle1;
echo round($other_cat, 2) . "
";
echo round($angle2, 2) . "
";

$a = 27; $b = 12;
$angleA = rad2deg(atan($a / $b));
$angleB = rad2deg(atan($b / $a));
echo round($angleA, 2) . "
";
echo round($angleB, 2) . "
";
echo "90.00
";

$a = 2; $b = 2.0; $c = '2'; $d = 'two'; $g = true; $f = false;
echo $a . $c . "
";
echo $c . $d . "
";
echo $g . $f . "
";
echo $a . $b . "
";

$a = 2; $b = 2.0; $c = '2'; $d = 'two'; $g = true; $f = false;
var_dump($a == $c);
var_dump($a === $c);
var_dump($g && $f);
var_dump($g || $f);
var_dump(!$f);
var_dump($a > $b);

var_dump($a != $d);
var_dump($c <> $d);
var_dump($g xor $f);
var_dump($a <= $b);

$a8 = true; $b8 = false;
var_dump($a8);
var_dump($b8);

$a = 2; $b = 2.0; $c = '2'; $d = 'two'; $g = true; $f = false;
echo $a + $a . "
";
echo $a + $c . "
";
echo $c + $c . "
";
echo $a * $c . "
";
echo $g + $f . "
";
echo $a % $c . "
";
echo $a / $a . "
";

$hunter = 'охотник';
${'wants-to'} = 'желает';
$know = 'знать';
$fizan = 'фазан';
$sits = 'сидит';
echo "Каждый {$hunter} {${'wants-to'}} {$know}, где {$sits} {$fizan}
";

$quieter = 'Тише';
$go = 'едешь';
$further = 'дальше';
echo "{$quieter} {$go} — {$further} будешь
";

${'not-take-risks'} = 'Кто не рискует';
${'not-drink'} = 'не пьет';
$ellipsis = '...';
echo "{${'not-take-risks'}}, тот {${'not-drink'}} {$ellipsis}
";

$give = 'Дают';
$take = 'бери';
$beat = 'бьют';
$run = 'беги';
echo "{$give} — {$take}, {$beat} — {$run}
";

echo $quieter . " " . $go . " — " . $further . " будешь
";

echo $give . " — " . $take . ", " . $beat . " — " . $run . "
";

echo ${'not-take-risks'} . ", тот " . ${'not-drink'} . " " . $ellipsis . "
";

echo "Каждый " . $hunter . " " . ${'wants-to'} . " " . $know . ", где " . $sits . " " . $fizan . "
";

$a = 4.3;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 7.7;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '5.5';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '3.4кг';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 4.6;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 7.3;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '3.8';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '7.9кг';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 5.7;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 4.2;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '7.4';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '8.9кг';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 5.7;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 8.3;
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '5.6';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = '9.2кг';
echo floor($a) . "
";
echo ceil($a) . "
";
echo round($a) . "
";

$a = 4; $b = 3; $c = ' мандаринок';
$a *= $b;
$a .= $c;
echo $a . "
";

$a = 7; $b = 4; $c = ' воробья';
$a -= $b;
$a .= $c;
echo $a . "
";

$a = 14; $b = 21; $c = 'ласточек';
$a += $b;
$a .= ' ' . $c;
echo $a . "
";

$a = 148; $b = 76; $c = ' голубя';
$a -= $b;
$a .= $c;
echo $a . "
";

$a = 54; $b = 6; $c = ' попугаев';
$a /= $b;
$a .= $c;
echo $a . "
";

$a = 2; $b = '2'; $d = '2a';
var_dump($a == $b);
var_dump($a == $d);
var_dump($b == $d);
var_dump($a >= $b);
var_dump($a <= $d);

$a = 3; $b = '3'; $d = '3a';
var_dump($a === $b);
var_dump($b === $d);
var_dump($a != $d);
var_dump($a <> $d);
var_dump($a > $d);
var_dump($a < $d);

$a = 2; $b = '2'; $d = '2a';
var_dump($a === $b);
var_dump($a === $d);
var_dump($b === $d);
var_dump($a != $b);
var_dump($a > $d);
var_dump($a < $b);

$a = 3; $b = '3'; $d = '3a';
var_dump($a == $b);
var_dump($a == $d);
var_dump($b == $d);
var_dump($a >= $d);
var_dump($a <= $b);

$a = 2; $b = 2.0; $c = '2'; $d = 'two'; $g = true; $f = false;
echo (int)$a . "
";
echo (int)$b . "
";
echo (int)$c . "
";
echo (int)$d . "
";
echo (int)$g . "
";
echo (int)$f . "
";

echo (float)$a . "
";
echo (float)$b . "
";
echo (float)$c . "
";
echo (float)$d . "
";
echo (float)$g . "
";
echo (float)$f . "
";

echo (string)$a . "
";
echo (string)$b . "
";
echo (string)$c . "
";
echo (string)$d . "
";
echo (string)$g . "
";
echo (string)$f . "
";

var_dump((bool)$a);
var_dump((bool)$b);
var_dump((bool)$c);
var_dump((bool)$d);
var_dump((bool)$g);
var_dump((bool)$f);

$a = 36; $b = '4';
echo ($a % $b > 0) ? "Тип: " . gettype($a / $b) . ", остаток: " . ($a % $b) : "$a / $b = " . ($a / $b);
echo "
";

$a = 148; $b = '51';
echo ($a % $b > 0) ? "Тип: " . gettype($a / $b) . ", остаток: " . ($a % $b) : "$a / $b = " . ($a / $b);
echo "
";

$a = 7; $b = '8';
echo ($a ** $b > $b ** $a) ? "$a ** $b = " . ($a ** $b) : "a = $a, b = $b";
echo "
";

$a = 7; $b = '8';
$incA = ++$a;
$decB = --$b;
echo ($incA > $decB) ? $incA : $decB;
echo "
";

$a = 27; $b = 12;
if ($a) {
    echo round($b / $a, 4) . "
";
} else {
    var_dump((bool)$a);
}

$a = 0; $b = 12;
if ($a) {
    echo round($b / $a, 4) . "
";
} else {
    var_dump((bool)$a);
}

$c = -27; $b = 12;
if ($c > 0 && $b > 0) {
    echo $c ** $b . "
";
} elseif ($c < 0 && $b < 0) {
    echo $c + $b . "
";
} else {
    echo $c * $b . "
";
}

$c = -27; $b = -12;
if ($c > 0 && $b > 0) {
    echo $c ** $b . "
";
} elseif ($c < 0 && $b < 0) {
    echo $c + $b . "
";
} else {
    echo $c * $b . "
";
}

$c = 27; $b = 12;
if ($c > 0 && $b > 0) {
    echo $c ** $b . "
";
} elseif ($c < 0 && $b < 0) {
    echo $c + $b . "
";
} else {
    echo $c * $b . "
";
}

$year = 2022; $month = 3; $day = 2;
echo sprintf("Дата: %04d-%02d-%02d", $year, $month, $day) . "
";

$money1 = 33.15; $money2 = 67.45;
$sum = $money1 + $money2;
echo sprintf("%08.3f", $sum) . "
";

$dateMech = '13:54';
$dateElec = '2022-03-18 13:54:14';
$clockMech = "Механические часы";
$clockElec = "Электронные часы";
echo sprintf("%s показывают %s", $clockMech, $dateMech) . "
";
echo sprintf("%s показывают %s", $clockElec, date("Y-m-d H:i:s", strtotime($dateElec))) . "
";

$number = 362525200;
echo sprintf("%.6e", $number) . "
";

$sum = 0;
for ($i = 1; $i <= 5; $i++) {
    $sum += $i;
}
echo $sum . "
";

$f = 'string';
$n = strlen($f);
$sum = 0;
for ($i = 1; $i <= $n; $i++) {
    $sum += $i;
}
echo $sum . "
";

$sum = 0;
$count = 0;
$i = 1;
do {
    if ($i % 2 == 0) {
        $sum += $i;
        $count++;
    }
    $i++;
} while ($count < 20);
echo $sum . "
";

$sum = 0;
$count = 0;
$i = 1;
while ($count < 20) {
    if ($i % 2 == 1) {
        $sum += $i;
        $count++;
    }
    $i++;
}
echo $sum . "
";

$sumA = 0;
$countA = 0;
$i = 3;
do {
    $sumA += $i;
    $countA++;
    $i += 3;
} while ($countA < 15);
echo $sumA . "
";

$sumB = 0;
$countB = 0;
$i = 3;
while ($countB < 15) {
    $sumB += $i;
    $countB++;
    $i += 3;
}
echo $sumB . "
";