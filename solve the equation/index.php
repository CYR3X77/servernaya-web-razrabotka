<?php
function solveEquation(string $equation)
{
    
    $eq = str_replace(' ', '', $equation);

    
    if (strpos($eq, '=') === false) {
        return "Ошибка: в уравнении нет знака '='";
    }
    [$left, $right] = explode('=', $eq, 2);

    
    if (!is_numeric($right)) {
        return "Ошибка: правая часть уравнения должна быть числом";
    }
    $c = (float)$right;

    
    $operators = ['*', '/', '+', '-'];
    $operator = null;
    $pos = false;

    foreach ($operators as $op) {
        $p = strpos($left, $op);
        if ($p !== false) {
            $operator = $op;
            $pos = $p;
            break;
        }
    }

    if ($operator === null) {
        return "Ошибка: не найден оператор (+, -, *, /) в уравнении";
    }

    
    $operandLeft  = substr($left, 0, $pos);
    $operandRight = substr($left, $pos + 1);

    
    $unknownName = null;
    $known = null;
    $unknownIsLeftOperand = null;

    if (!is_numeric($operandLeft)) {
        $unknownName = $operandLeft;
        $known = (float)$operandRight;
        $unknownIsLeftOperand = true;
    } elseif (!is_numeric($operandRight)) {
        $unknownName = $operandRight;
        $known = (float)$operandLeft;
        $unknownIsLeftOperand = false;
    } else {
        return "Ошибка: в уравнении не найдена неизвестная переменная";
    }

    $x = null;
    switch ($operator) {
        case '*':
            
            if ($known == 0) return "Ошибка: деление на 0";
            $x = $c / $known;
            break;

        case '+':
            
            $x = $c - $known;
            break;

        case '-':
            if ($unknownIsLeftOperand) {
                
                $x = $c + $known;
            } else {
                
                $x = $known - $c;
            }
            break;

        case '/':
            if ($unknownIsLeftOperand) {
                
                $x = $c * $known;
            } else {
                
                if ($c == 0) return "Ошибка: деление на 0";
                $x = $known / $c;
            }
            break;
    }

    return [
        'operator' => $operator,
        'unknown'  => $unknownName,
        'position' => $unknownIsLeftOperand ? 'слева' : 'справа',
        'value'    => $x,
    ];
}

$equation = "4 * X = 36";
$result = solveEquation($equation);

if (is_array($result)) {
    echo "Уравнение: {$equation}\n";
    echo "Оператор: {$result['operator']}\n";
    echo "Неизвестная переменная: {$result['unknown']} (расположена {$result['position']})\n";
    echo "Значение переменной {$result['unknown']} = {$result['value']}\n";
} else {
    echo $result . "\n";
}