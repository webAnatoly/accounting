<?php

require $_SERVER['DOCUMENT_ROOT'] . '/accounting/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/accounting/Math.php';
require $_SERVER['DOCUMENT_ROOT'] . '/accounting/Logger.php';
$db = config\Config::getDb();

$cn = new math\Complex;

var_dump($cn->re);

// Создаем в цикле много объектов FileLogger0
for ($n = 0; $n < 4; $n++) {
    $logger = new Logger\FileLogger("test$n", "test.log");
    $logger->log("Hello!");
    // Представим, что мы случайно забыли вызвать close()
    $logger->close();
}

