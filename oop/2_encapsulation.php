<?php


class Cat
{
    private string $name;
    private string $color;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function sayHello(): string
    {
        return "Привет, меня зовут {$this->name}. Я {$this->color} цвета.";
    }

    public function getColor(): string
    {
        return $this->color;
    }
}


$cat1 = new Cat('Барсик', 'рыжий');
$cat2 = new Cat('Мурка', 'чёрный');

echo $cat1->sayHello() . PHP_EOL; 
echo $cat2->sayHello() . PHP_EOL; 


echo 'Цвет первой кошки: ' . $cat1->getColor() . PHP_EOL;