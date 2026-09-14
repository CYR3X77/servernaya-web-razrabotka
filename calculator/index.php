<?php


$initialExpr   = isset($_GET['expr']) ? (string) $_GET['expr'] : '';
$initialResult = isset($_GET['result']) ? (string) $_GET['result'] : null;
$initialError  = isset($_GET['error']) ? (string) $_GET['error'] : null;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Калькулятор</title>
<style>
    :root {
        --bg: #1b1c1f;
        --panel: #232428;
        --display-bg: #101114;
        --btn: #2f3136;
        --btn-hover: #3a3c42;
        --op: #ff9f0a;
        --op-hover: #ffb74d;
        --fn: #3a3f4b;
        --fn-hover: #4a5060;
        --danger: #ff453a;
        --text: #f2f2f2;
        --muted: #8b8d93;
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        font-family: 'Segoe UI', Arial, sans-serif;
    }
    .calculator {
        background: var(--panel);
        border-radius: 18px;
        padding: 20px;
        width: 340px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }
    .display {
        background: var(--display-bg);
        border-radius: 12px;
        padding: 18px 14px;
        margin-bottom: 14px;
        text-align: right;
        min-height: 76px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }
    .display .error {
        color: var(--danger);
        font-size: 13px;
        margin-bottom: 4px;
        min-height: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    #display {
        width: 100%;
        border: none;
        background: transparent;
        color: var(--text);
        font-size: 28px;
        text-align: right;
        outline: none;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
    }
    button {
        border: none;
        border-radius: 10px;
        padding: 14px 0;
        font-size: 16px;
        cursor: pointer;
        background: var(--btn);
        color: var(--text);
        transition: background .12s ease;
    }
    button:hover { background: var(--btn-hover); }
    button:active { transform: scale(0.96); }
    button.op { background: var(--op); color: #1b1c1f; font-weight: 600; }
    button.op:hover { background: var(--op-hover); }
    button.fn { background: var(--fn); font-size: 13px; }
    button.fn:hover { background: var(--fn-hover); }
    button.wide { grid-column: span 2; }
    button.clear { background: var(--danger); color: #fff; }
    button.clear:hover { background: #ff6b60; }
    button.equals { background: var(--op); color: #1b1c1f; font-weight: 700; }
    button.equals:hover { background: var(--op-hover); }
    .hint {
        margin-top: 10px;
        text-align: center;
        color: var(--muted);
        font-size: 11px;
    }
</style>
</head>
<body>

<div class="calculator">
    <div class="display">
        <div class="error" id="errorLine"></div>
        <input type="text" id="display" readonly value="">
    </div>

    <div class="grid">
        <button class="fn" data-append="pi">π</button>
        <button class="fn" data-append="e">e</button>
        <button class="fn" data-append="sqrt(">√</button>
        <button class="fn" data-append="ln(">ln</button>
        <button class="fn" data-append="log(">log</button>

        <button class="fn" data-append="^">x^y</button>
        <button class="fn" data-append="!">n!</button>
        <button data-append="(">(</button>
        <button data-append=")">)</button>
        <button class="clear" id="clearBtn">C</button>

        <button data-append="7">7</button>
        <button data-append="8">8</button>
        <button data-append="9">9</button>
        <button class="op" data-append="/">÷</button>
        <button id="backspaceBtn">⌫</button>

        <button data-append="4">4</button>
        <button data-append="5">5</button>
        <button data-append="6">6</button>
        <button class="op" data-append="*">×</button>
        <button data-append="-">−</button>

        <button data-append="1">1</button>
        <button data-append="2">2</button>
        <button data-append="3">3</button>
        <button class="op" data-append="+">+</button>
        <button data-append=".">.</button>

        <button data-append="0" class="wide">0</button>
        <button class="equals wide" id="equalsBtn">=</button>
    </div>

    <div class="hint">Ввод с клавиатуры также поддерживается (0-9, + - * / ^ ( ) ., Enter, Backspace, Esc)</div>
</div>

<form id="calcForm" action="calc.php" method="POST" style="display:none;">
    <input type="hidden" name="expression" id="expressionField" value="">
</form>

<script>
(function () {
    var display = document.getElementById('display');
    var errorLine = document.getElementById('errorLine');
    var form = document.getElementById('calcForm');
    var expressionField = document.getElementById('expressionField');

    var initialExpr   = <?php echo json_encode($initialExpr, JSON_UNESCAPED_UNICODE); ?>;
    var initialResult = <?php echo $initialResult !== null ? json_encode($initialResult, JSON_UNESCAPED_UNICODE) : 'null'; ?>;
    var initialError  = <?php echo $initialError !== null ? json_encode($initialError, JSON_UNESCAPED_UNICODE) : 'null'; ?>;

    function setDisplay(value) {
        display.value = value;
    }
    function setError(message) {
        errorLine.textContent = message || '';
    }

    if (initialResult !== null) {
        setDisplay(initialResult);
        setError('');
    } else if (initialError !== null) {
        setDisplay(initialExpr);
        setError(initialError);
    } else {
        setDisplay('');
        setError('');
    }

    function appendToDisplay(text) {
        setError('');
        display.value += text;
    }

    function clearDisplay() {
        display.value = '';
        setError('');
    }

    function backspace() {
        display.value = display.value.slice(0, -1);
    }

    function submitCalculation() {
        var expr = display.value.trim();
        if (expr === '') {
            setError('Введите выражение');
            return;
        }
        expressionField.value = expr;
        form.submit(); 
    }

    document.querySelectorAll('[data-append]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            appendToDisplay(btn.getAttribute('data-append'));
        });
    });

    document.getElementById('clearBtn').addEventListener('click', clearDisplay);
    document.getElementById('backspaceBtn').addEventListener('click', backspace);
    document.getElementById('equalsBtn').addEventListener('click', submitCalculation);

    document.addEventListener('keydown', function (e) {
        var key = e.key;
        var allowedChars = '0123456789+-*/^().!';

        if (allowedChars.indexOf(key) !== -1) {
            e.preventDefault();
            appendToDisplay(key);
            return;
        }

        switch (key) {
            case 'Enter':
            case '=':
                e.preventDefault();
                submitCalculation();
                break;
            case 'Backspace':
                e.preventDefault();
                backspace();
                break;
            case 'Escape':
                e.preventDefault();
                clearDisplay();
                break;
            case 'p': 
                if (e.altKey) { e.preventDefault(); appendToDisplay('pi'); }
                break;
        }
    });
})();
</script>

</body>
</html>