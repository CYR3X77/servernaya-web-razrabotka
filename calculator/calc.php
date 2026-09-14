<?php

session_start();

function redirectWithError(string $expr, string $message): void
{
    $url = 'index.php?' . http_build_query([
        'expr'  => $expr,
        'error' => $message,
    ]);
    header('Location: ' . $url);
    exit;
}

function redirectWithResult(string $expr, $result): void
{
    $url = 'index.php?' . http_build_query([
        'expr'   => $expr,
        'result' => $result,
    ]);
    header('Location: ' . $url);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['expression'])) {
    header('Location: index.php');
    exit;
}

$rawExpression = trim($_POST['expression']);

if ($rawExpression === '') {
    redirectWithError($rawExpression, 'Пустое выражение');
}


if (!preg_match('/^[0-9\.\+\-\*\/\^\!\(\)\s a-zA-Z]+$/u', $rawExpression)) {
    redirectWithError($rawExpression, 'Выражение содержит недопустимые символы');
}

function tokenize(string $expr): array
{
    $pattern = '/\s*(\d+\.\d+|\.\d+|\d+|[A-Za-z]+|[\+\-\*\/\^\!\(\)])\s*/u';
    preg_match_all($pattern, $expr, $matches, PREG_PATTERN_ORDER);

    $reconstructed = implode('', $matches[1]);
    $stripped = preg_replace('/\s+/', '', $expr);
    if ($reconstructed !== $stripped) {
        throw new InvalidArgumentException('Не удалось разобрать выражение');
    }

    return $matches[1];
}


class ExpressionCalculator
{
    /** @var string[] */
    private array $tokens;
    private int $pos = 0;

    private const FUNCTIONS  = ['sqrt', 'ln', 'log'];
    private const CONSTANTS  = ['pi', 'e'];

    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    public function evaluate(): float
    {
        $result = $this->parseExpression();
        if ($this->pos !== count($this->tokens)) {
            throw new InvalidArgumentException('Лишние символы в выражении: "' . $this->peek() . '"');
        }
        return $result;
    }

    private function peek(): ?string
    {
        return $this->tokens[$this->pos] ?? null;
    }

    private function next(): string
    {
        if ($this->pos >= count($this->tokens)) {
            throw new InvalidArgumentException('Неожиданный конец выражения');
        }
        return $this->tokens[$this->pos++];
    }

    private function parseExpression(): float
    {
        $value = $this->parseTerm();

        while (in_array($this->peek(), ['+', '-'], true)) {
            $op = $this->next();
            $right = $this->parseTerm();
            $value = $op === '+' ? $this->add($value, $right) : $this->subtract($value, $right);
        }

        return $value;
    }

    private function parseTerm(): float
    {
        $value = $this->parsePower();

        while (in_array($this->peek(), ['*', '/'], true)) {
            $op = $this->next();
            $right = $this->parsePower();
            $value = $op === '*' ? $this->multiply($value, $right) : $this->divide($value, $right);
        }

        return $value;
    }

    private function parsePower(): float
    {
        $value = $this->parseUnary();

        if ($this->peek() === '^') {
            $this->next();
            $exponent = $this->parsePower(); // рекурсивный вызов вправо
            $value = $this->power($value, $exponent);
        }

        return $value;
    }

    
    private function parseUnary(): float
    {
        if ($this->peek() === '-') {
            $this->next();
            return $this->negate($this->parseUnary()); 
        }
        if ($this->peek() === '+') {
            $this->next();
            return $this->parseUnary();
        }
        return $this->parsePostfix();
    }

    private function parsePostfix(): float
    {
        $value = $this->parsePrimary();

        while ($this->peek() === '!') {
            $this->next();
            $value = $this->factorial($value);
        }

        return $value;
    }

    private function parsePrimary(): float
    {
        $token = $this->peek();

        if ($token === null) {
            throw new InvalidArgumentException('Неожиданный конец выражения');
        }

        // Число
        if (is_numeric($token)) {
            $this->next();
            return (float) $token;
        }

        if ($token === '(') {
            $this->next();
            $value = $this->parseExpression();
            if ($this->peek() !== ')') {
                throw new InvalidArgumentException('Не хватает закрывающей скобки');
            }
            $this->next();
            return $value;
        }

        if (preg_match('/^[A-Za-z]+$/', $token)) {
            $this->next();
            $name = strtolower($token);

            if (in_array($name, self::CONSTANTS, true)) {
                return $this->constant($name);
            }

            if (in_array($name, self::FUNCTIONS, true)) {
                if ($this->peek() !== '(') {
                    throw new InvalidArgumentException("После функции \"$name\" ожидается \"(\"");
                }
                $this->next();
                $arg = $this->parseExpression();
                if ($this->peek() !== ')') {
                    throw new InvalidArgumentException('Не хватает закрывающей скобки');
                }
                $this->next();
                return $this->callFunction($name, $arg);
            }

            throw new InvalidArgumentException("Неизвестный идентификатор \"$name\"");
        }

        throw new InvalidArgumentException("Неожиданный токен \"$token\"");
    }


    private function add(float $a, float $b): float
    {
        return $a + $b;
    }

    private function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    private function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    private function divide(float $a, float $b): float
    {
        if ($b == 0.0) {
            throw new InvalidArgumentException('Деление на ноль');
        }
        return $a / $b;
    }

    private function negate(float $a): float
    {
        return -$a;
    }

    private function power(float $base, float $exponent): float
    {
        if ($exponent == floor($exponent) && $exponent >= 0) {
            return $this->intPower($base, (int) $exponent);
        }
        if ($exponent == floor($exponent) && $exponent < 0) {
            if ($base == 0.0) {
                throw new InvalidArgumentException('0 в отрицательной степени не определено');
            }
            return 1 / $this->intPower($base, (int) (-$exponent));
        }
        if ($base < 0) {
            throw new InvalidArgumentException('Дробная степень отрицательного числа не определена');
        }
        return exp($exponent * log($base));
    }

    private function intPower(float $base, int $exp): float
    {
        if ($exp === 0) {
            return 1.0;
        }
        $half = $this->intPower($base, intdiv($exp, 2));
        $result = $half * $half;
        if ($exp % 2 !== 0) {
            $result *= $base;
        }
        return $result;
    }

    private function factorial(float $n): float
    {
        if ($n < 0 || $n != floor($n)) {
            throw new InvalidArgumentException('Факториал определён только для неотрицательных целых чисел');
        }
        return $this->factorialRecursive((int) $n);
    }

    private function factorialRecursive(int $n): float
    {
        if ($n === 0 || $n === 1) {
            return 1.0;
        }
        return $n * $this->factorialRecursive($n - 1);
    }

    private function constant(string $name): float
    {
        return $name === 'pi' ? M_PI : M_E;
    }

    private function callFunction(string $name, float $arg): float
    {
        switch ($name) {
            case 'sqrt':
                if ($arg < 0) {
                    throw new InvalidArgumentException('Корень из отрицательного числа не определён');
                }
                return sqrt($arg);
            case 'ln':
                if ($arg <= 0) {
                    throw new InvalidArgumentException('ln определён только для положительных чисел');
                }
                return log($arg); 
            case 'log':
                if ($arg <= 0) {
                    throw new InvalidArgumentException('log определён только для положительных чисел');
                }
                return log10($arg); 
            default:
                throw new InvalidArgumentException("Неизвестная функция \"$name\"");
        }
    }
}


try {
    $tokens = tokenize($rawExpression);
    if (empty($tokens)) {
        throw new InvalidArgumentException('Пустое выражение');
    }
    $calculator = new ExpressionCalculator($tokens);
    $result = $calculator->evaluate();

    if (is_nan($result) || is_infinite($result)) {
        throw new InvalidArgumentException('Результат не является числом (переполнение или неопределённость)');
    }

    $result = round($result, 10);
    $resultStr = rtrim(rtrim(sprintf('%.10F', $result), '0'), '.');
    if ($resultStr === '' || $resultStr === '-0') {
        $resultStr = '0';
    }

    redirectWithResult($rawExpression, $resultStr);
} catch (InvalidArgumentException $e) {
    redirectWithError($rawExpression, $e->getMessage());
} catch (Throwable $e) {
    redirectWithError($rawExpression, 'Ошибка вычисления выражения');
}