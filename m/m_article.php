<? //This file is property of Duckcode company, Russia.

class M_Article
{
    private static $instance;
    private $mMysql;

    public static function getInstance()
    {
        if(self::$instance == null)
            self::$instance = new M_Article();

        return self::$instance;
    }

    private function __construct()
    {
        $this->mMysql = M_Mysql::getInstance();
    }

    /** Получение всех статей
     * @param $table_name - имя таблицы в БД
     * @return array - ассоциативный массив
     */
    public function getAll($table_name)
    {
        $sql = "SELECT * FROM dckc_%s";
        $query = sprintf($sql, $table_name);

        return $this->mMysql->select($query);
    }

    /** Получение одной статьи
     * @param $table_name - имя таблицы в БД
     * @param $id - идентификатор статьи
     * @return array - ассоциативный массив
     */
    public function get($table_name, $id)
    {
        $sql = "SELECT * FROM dckc_%s WHERE id = '%d'";
        $query = sprintf($sql, $table_name, $id);

        return $this->mMysql->select($query);
    }

    /** Добавление статьи
     * @param $table_name - имя таблицы в БД
     * @param $title - заголовк статьи
     * @param $content - содержание статьи
     * @param $action - параметр для новостей входящих в акцию
     * @return bool - удачное\неудачное добавление
     */
    public function add($table_name, $title, $content, $action)
    {
        $title = $this->mMysql->clearStr($title);
        $content = $this->mMysql->clearStr($content);
        $action = $this->mMysql->clearStr($action);

        if($title == '')
            return false;

        $obj = array();

        $obj["title"] = $title;
        $obj["content"] = $content;
        $obj["action"] = $action;

        $this->mMysql->insert($table_name, $obj);

        return true;
    }

    /** Редактирование статьи
     * @param $table_name - имя таблицы в БД
     * @param $title - заголовок статьи
     * @param $content - содержание статьи
     * @param $action - параметр для новостей входящих в акцию
     * @param $id - идентификатор статьи
     * @return bool - удачное\неудачное редактирование
     */
    public function edit($table_name, $title, $content, $action, $id)
    {
        $id = $this->mMysql->clearInt($id);
        $query = "id = '%d'";
        $where = sprintf($query, $id);

        $obj = array();

        $obj['title'] = $title;
        $obj['content'] = $content;
        $obj['action'] = $action;

        if($title == '')
            return false;

        $this->mMysql->update($table_name, $obj, $where);

        return true;
    }

    /** Удаление статьи
     * @param $table_name - имя таблицы в БД
     * @param $id - идентификатор статьи
     */
    public function del($table_name, $id)
    {
        $orders = "id = " . abs(trim((int)$id));

        $this->mMysql->del($table_name, $orders);
    }
}