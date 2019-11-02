<?php

namespace Logger;

/** Класс, упрощающий ведение разного рода журналов */
class FileLogger
{
    public $f; // открытый файл
    public $name; // имя журнала
    public $lines = []; // накапливаемые строки
    public $t;

    // Создает новый файл журнала или открывает дозапись в конец
    // существующего. Параметр $name - логическое имя журнала.
    public function __construct($name, $fname)
    {
        $fname = $_SERVER['DOCUMENT_ROOT'] . '/accounting/logs/' . $fname;
        $this->name = $name;
        $this->f = fopen($fname, "a+");
        $this->log("### __construct() called!");
    }
    // Добавляет в журнал одну строку. Она не попадает в файл сразу
    // же, а накапливается в буфере - до самого закрытия (close()).
    public function log($str)
    {
        // Каждая строка предваряется текущей датой и именем журнала
        $prefix = "[".date("Y-m-d_h:i:s ")."{$this->name}] ";
        $str = preg_replace('/^/m', $prefix, rtrim($str));

        // Сохраняем строку.
        $this->lines[] = $str."\n";
    }
    // Закрывает файл журнала. Должна ОБЯЗАТЕЛЬНО вызываться
    // в конце работы с объектом!
    public function close()
    {
        // Вначале выводим все накопленные данные
        fputs($this->f, join("", $this->lines));
        // Затем закрываем файл
        fclose($this->f);
    }

    // Гарантированно вызывается при уничтожении объекта.
    // Закрывает файл журнала.
    public function __destruct()
    {
        $this->log("### __destruct() called!");
    }
}