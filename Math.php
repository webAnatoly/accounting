<?php

namespace math;


class Complex
{

    // Свойства: действительная и мнимая части
    private $re, $im;

    public function __construct($re=0, $im=0)
    {
        $this->re = $re;
        $this->im = $im;
    }

    // Метод: добавить число к текущему значению. Число задается
    // своей действительной и мнимой частью
    public function add($re=0, $im=0)
    {
        $this->re += $re;
        $this->im += $im;

        return array($this->re, $this->im);
    }

    public function __toString()
    {
        return "I'm Complex number. {$this->re}" . "   " . "{$this->im}";
    }

    public function __get($name) {
        return "you try get private property";
    }
}