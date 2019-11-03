<?php

/**
 * Автозагрузка классов из корневой папки проекта. И из папки classes.
 * В корневой папке классы можно писать и с namespase и без него. Главное, чтобы имя файла совпадало с именем класса.
 * Во вложенных папках в namespase нужно указывать имя папки,
 * например для папки class с классом Test.php namespace должен быть таким namespase class\Test;
 * @return void
 */
function myAutoloader($className)
{

    // заменить обратные слеши на прямые
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    // получаем самую первую часть пути. Т.е. ту часть которая от начала пути, до первого слеша
    $firstPart = preg_match('/^[a-zA-Z0-9_.-]*/i', $className, $matches);

    if ($firstPart === 1) {
        $firstPart = $matches[0];
    } else {
        $firstPart = "";
    }

    // получаем последнею часть пути, т.е. ту которая после последнего слеша
    $baseName = basename($className);

    // Если имя класса и первая часть совпадают. Значит было передано просто одно слово, без слешей.
    if ($className === $firstPart) {
        include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $className . '.php';
        return;
    }

    // Если первая часть имени является именем папки, то подставляем это имя в путь.
    switch ($firstPart) {
        case 'classes':
            include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $firstPart . DIRECTORY_SEPARATOR . $baseName . '.php';
            break;
        default:
            include_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $baseName . '.php';
            break;
    }

}