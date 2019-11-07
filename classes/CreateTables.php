<?php

namespace classes;

/**
 * Создает таблицы для вновь зарегистрированного пользователя
 * Каждая таблица имеет префикс u_*** где *** идентефикатор пользователя
*/
class CreateTables
{

    public function __construct($a=4)
    {
        $this->a = $a;
    }

    public static function create($user_id=0)
    {
        if ($user_id === 0 || !is_int($user_id) ) { return "user id must be number greter zero"; }
    }
    
    /** Для каждого счета создать таблицу (Имеется ввиду план счетов бухгалтерского учета).
     * Таблицы создаются не прям для каждого счета, а только для основных, которые будут использоваться в приложении */
    private function chartOfAccounts($user_id="")
    {
        if ($user_id === 0 || !is_int($user_id) ) { return "user id must be number greter zero"; }

        // [TO DO] Сделать проверку что пользователь с таким номером не существует


        // номера счетов бухучета согласно правилам бухучета.
        $activeAccounts = [
            "01" => "Основные средства",
            "10" => "Mатериалы",
            "50" => "Касса",
            "51" => "Рассчетный счет",
            "55.3" => "Депозитные счета",
            "58.1" => "Паи и акции",
            "60" => "Рассчеты с поставщиками и подрядчиками",
        ];
        $passiveAccounts = [
            "02" => "Амортизация основных средств",
            "75" => "Рассчеты с учредителями",
            "76" => "Расчеты с разными дебиторами и кредиторами",
            "80" => "Уставный капитал",
            "82" => "Резервный капитал",
            "83" => "Добавочный капитал",
            "84" => "Нераспределенная прибыль (непокрытый убыток)",
            "90.9" => "Прибыль (убыток) от продаж",

        ];
        $prefix = "u_" . $user_id . "_acc_";

        $acc_50 = <<<ACC_50
        CREATE TABLE acc_50(
            id INT AUTO_INCREMENT,
            first_name VARCHAR(100),
            last_name VARCHAR(100),
            email VARCHAR(50),
            password VARCHAR(20),
            location VARCHAR(100),
            dept VARCHAR(100),
            is_admin TINYINT(1),
            register_date DATETIME,
            PRIMARY KEY(id)
            );
ACC_50;
    }

    /** Создать свой счет. Так как это приложение для учета личных финансов, то можно создавать придумывать свои счета (т.е. не включенные в план счетов ПБУ) */
    public static function creatCustomAccount($name="")
    {
        if ($name === "") {"error: you must name you account"; }
    }

    /** Проверяет существует ли таблица
     * @param string table name
     * @return bool true if table exist, otherwise false
     */
    public static function isTableExist(string $tableName="")
    {
        // require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';
        $db = \Config\Config::getDb();

        $result = false;

        // проверка существует ли таблица
        $query = "SHOW TABLES LIKE '" . $tableName . "'";

        if ($st = $db->prepare($query)) {
            // $st->bind_param("s", $query);
            $st->execute();
            $st->bind_result($fetched_tableName);
            $st->fetch();
            $st->close();

        } else {
            die ("db connect error");
        }

        if ($tableName === $fetched_tableName) {
            $result = true;
        }

        return $result;
        
    }
}
