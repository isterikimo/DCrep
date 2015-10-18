<?php //This file is property of Duckcode company, Russia.

class M_Mysql
{
    private static $instance;
    private $ref;

    /**
     * Подключение интерфейса БД
     * @return M_Mysql - класс БД
     */
    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new M_Mysql();
        }

        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
        $this->ref = mysqli_connect("localhost",
                                    "root",
                                    "",
                                    "dckc_parkhaus");
    }

    /**
     * Отчистка строковой переменной
     * @param $data
     * @return string
     */
    public function clearStr($data)
    {
        return mysqli_real_escape_string($this->ref, trim(strip_tags($data)));
    }

    /**
     * Отчистка числовой переменной
     * @param $data
     * @return number
     */
    public function clearInt($data)
    {
        return abs(trim((int)$data));
    }

    /**
     * Выборка из базы
     * @param $query - текст запроса
     * @return array - ассоциативный массив
     */
    public function select($query)
    {
        $res = mysqli_query($this->ref, $query);

        if(!$res)
            header("location: v/v_error.php");

        while($row = mysqli_fetch_assoc($res)){
            $arr[] = $row;
        }

        return $arr;
    }

    /**
     * Вставка в базу
     * @param $table_name - имя таблицы
     * @param $obj - массив, где ключ - название столбца.
     * @return int - количество затронутых строк
     */
    public function insert($table_name, $obj)
    {
        $columns = array();
        $values = array();

        foreach($obj as $key => $val){
            $columns[] = $this->clearStr($key);

            if($val === null){
                $values[] = "NULL";
            } else{
                $val = $this->clearStr($val);
                $values[] = "'$val'";
            }
        }

        $columns_s = implode(",", $columns);
        $values_s = implode(",", $values);

        $query = "INSERT INTO $table_name($columns_s) VALUE($values_s)";
        $result = mysqli_query($this->ref, $query);

        if(!$result)
            die(mysqli_error($this->ref));

        return mysqli_affected_rows($this->ref);
    }

    /**
     * Обновление данных в базе
     * @param $table_name - имя таблицы
     * @param $obj - массив, где ключ - имя столбца
     * @return int - количество затронутых строк
     */
    public function update($table_name, $obj, $order)
    {
        $term = array();

        foreach($obj as $key => $val){
            $column = $this->clearStr($key);
            $value = $this->clearStr($val);

            $term[] = "$column = '$value'";
        }
        $terms = implode(",", $term);
        $sql = "UPDATE $table_name SET $terms WHERE $order";
        return mysqli_affected_rows($this->ref);
    }

    /**
     * Удаление из базы
     * @param $table_name
     * @param $orders
     * @return int
     */
    public function del($table_name, $orders)
    {
        $query = "DELETE FROM $table_name WHERE $orders";

        $res = mysqli_query($this->ref, $query);

        if(!$res)
            die(mysqli_error($this->ref));

        return mysqli_affected_rows($this->ref);
    }
}