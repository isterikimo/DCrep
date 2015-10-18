<? //This file is the property of «Duckcode», Russia

class M_Mysql
{
    public static $instance;
    public $ref;

    /** Инициализация подключения
     * $ref - ссылка на подключение
     * setlocale - локация языка и кодировки
     * set names - кодировка вводимых значений
     */
    private function __construct()
    {
        $this->ref = mysqli_connect(
                                    DB_HOST,
                                    DB_LOGIN,
                                    DB_PASSWORD,
                                    DB_NAME_PREF . DB_NAME)
                                    or die($this->eMessage());

        setlocale(LC_ALL, 'ru_RU.UTF-8');
        mysqli_query($this->ref, 'SET NAMES UTF-8');
    }

    /** Инициализация объекта singleton
     * @return M_Mysql - объект класса
     */
    public static function instance()
    {
        if(self::$instance == null)
            self::$instance = new M_Mysql();

        return self::$instance;
    }

    /** Выбор из БД
     * @param $query - запрос
     * @return array - массив ключ - имя поля, значение - значение поля
     */
    public function select($query)
    {
        $res = mysqli_query($this->ref, $query);

        if(!$res)
            die($this->eMessage());

        while($row = mysqli_fetch_assoc($res)){
            $arr[] = $row;
        }

        return $arr;
    }

    /** Вставка в таблицу
     * @param $tableName - имя таблицы
     * @param array $obj - массив вида "имя столбца - значение"
     * @return int|string - идентификатор новой строки
     */
    public function insert($tableName, array $obj)
    {
        $columns = array();
        $values = array();

        foreach($obj as $key => $val){
            $columns[] = $this->clearStr($key);

            if($val === null){
                $values[] = 'NULL';
            }else{
                $val = $this->clearStr($val);
                $values[] = "'$val'";
            }
        }

        $columns2str = implode(',', $columns);
        $values2str = implode(',', $values);

        $query = "INSERT INTO $tableName($columns2str) VALUE($values2str)";
        $result = mysqli_query($this->ref, $query);

        if(!$result)
            die($this->eMessage());

        return mysqli_insert_id($this->ref);
    }

    public function update($tableName, array $obj, $where)
    {
        $sets = array();

        foreach($obj as $key => $val){
            $key = $this->clearStr($key);

            if($val === null){
                $sets[] = 'NULL';
            }else{
                $val = $this->clearStr($val);
                $sets[] = "$key = '$val'";
            }
        }

        $sets2str = implode(',', $sets);

        $query = "UPDATE $tableName SET $sets2str WHERE $where";

        $result = mysqli_query($this->ref, $query);

        if(!$result)
            die($this->eMessage());

        return mysqli_affected_rows($this->ref);
    }

    public function delete($tableName, $where)
    {
        $q = "DELETE FROM $tableName WHERE $where";
        $query = sprintf($q, $where);

        $result = mysqli_query($this->ref, $query);

        if(!$result)
            die($this->eMessage());

        return mysqli_affected_rows($this->ref);
    }

    public function clearStr($data)
    {
        return mysqli_real_escape_string($this->ref, trim(strip_tags($data) . ''));
    }

    public function eMessage()
    {
        return mysqli_error($this->ref);
    }
}