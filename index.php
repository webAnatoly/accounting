<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/myAutoloader.php';

// spl_autoload_register("myAutoloader");
spl_autoload_register("mySecondAutoloader");

$db = Config\Config::getDb();

// $isTableExist = classes\CreateTables\CreateTables::isTableExist();
$isTableExist = classes\CreateTables::isTableExist();

var_dump($isTableExist);

$cn = new Math();
$t = new Test();
$t2 = new classes\Test();
var_dump($t2);

$any = new classes\subclass\Any;

$anotherTest = new AnotherTest("Bye");
var_dump($anotherTest->val);
// Создаем в цикле много объектов FileLogger0
// for ($n = 0; $n < 4; $n++) {
//     $logger = new Logger\FileLogger("test$n", "test.log");
//     $logger->log("Hello!");
//     // Представим, что мы случайно забыли вызвать close()
//     $logger->close();
// }

