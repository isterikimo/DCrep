<? //This file is the property of «Duckcode», Russia

class M_Users
{
    protected $user;
    protected $uid;
    protected $sid;
    protected $mMysql;
    protected $privsCache;
    private static $instance;

    /** Конструктор
     * Создание экземпляра класса БД в поле $this->mMysql
     */
    protected function __construct()
    {
        $this->mMysql = M_Mysql::instance();
    }

    /** Создание экземпляра класса M_users
     * @return M_Users
     */
    public static function instance()
    {
            if(self::$instance == null)
                self::$instance = new self();

            return self::$instance;
    }

    /** Логинизация пользователя
     * @param $login - логин пользователя (email)
     * @param $password - пароль
     * @param $name - ник
     * @param null $remember - нужно ли запоминать
     * @return bool - true - если пользователь существует
     */
    public function login($login, $password, $name, $remember = null)
    {
        //Получение пользоваетеля по логину
        $user = $this->getByLogin($this->mMysql->clearStr($login));

        // Если нет - false
        if($user == null)
            return false;

        // Если пароли не свопадают - false
        if($user['password'] != md5(md5($password)))
            return false;

        // Если поставлен chekbox - remember - сажаем куку
        if($remember){
            $expire = time() + 3600 * 24 * 100;
            setcookie('login', $login, $expire);
            setcookie('password', md5(md5($password)), $expire);
            setcookie('name', $name, $expire);
            }

        // Присваивание идентификатора сессии в поле класса (кэш)
        $this->sid = $this->openSession($user["id_user"]);

        return true;
    }

    public function logout()
    {
        $expire = time() - 3600;
        setcookie('login', '', $expire);
        setcookie('password', '', $expire);
        setcookie('name', '', $expire);
        unset($_COOKIE['login']);
        unset($_COOKIE['password']);
        unset($_COOKIE['name']);
        unset($_SESSION['sid']);

        $this->sid = null;
        $this->uid = null;
    }

    /** Получение пользователя по Логину
     * @param $login - логин
     * @return array - массив с информацией о пользователе
     */
    public function getByLogin($login)
    {
        // Формирование имени таблицы и запроса
        $tableName = TBL_PREF . "users";
        $q = "SELECT * FROM $tableName WHERE login = '%s'";
        $query = sprintf($q, $this->mMysql->clearStr($login));

        // Поиск записей в БД
        $result = $this->mMysql->select($query);

        return $result[0];
    }

    /** Получение текущего пользователя
     * @param null $id_user
     * @return null
     */
    public function get($id_user = null)
    {
        // Если id не передан - попытка достать его через метод getUid()
        if($id_user == null)
            $id_user = $this->getUid();

        // Если все еще нет id - возвращаем null
        if($id_user == null)
            return null;

        // если id был найден - формируем имя таблицы и запрос
        $tableName = TBL_PREF . "users";
        $q = "SELECT * FROM $tableName WHERE id_user = '%d'";
        $query = sprintf($q, $id_user);

        // Получение записис из БД по ключу id_user
        $result = $this->mMysql->select($query);

        return $result[0];
    }

    /** Получение id пользователя
     * @return null/id_user
     */
    public function getUid()
    {
        // Если поле класса НЕ пусто возвращаем значение id
        if($this->uid != null)
            return $this->uid;

        // Ищем идентификатор сессии через метод getSid()
        $sid = $this->getSid();

        // если сессии нет - возвращаем null
        if($sid == null)
            return null;

        // Если нашли идентификатор сессии:
        // формируем имя базы и запрос на поиск сессии по sid
        $table_name = TBL_PREF . 'users_sessions';
        $q = "SELECT id_user FROM $table_name WHERE sid = '%s'";
        $query = sprintf($q, $this->mMysql->clearStr($sid));

        $result = $this->mMysql->select($query);

        // Если нет такой сессии - возыращаем null
        if(count($result) == 0)
            return null;

        // Если есть сесссия - присваиваем id_user - в поле класса (кэш)
        $this->uid = $result[0]['id_user'];

        return $this->uid;
    }

    /** Получение идентификатора сессии
     * @return mixed|null SID - любо не найден, либо строка
     */
    public function getSid()
    {
        // Проверка кэша
        if($this->sid != null)
            return $this->sid;

        // Проверка php сессии
        if(isset($_SESSION['sid'])){
            $sid = $_SESSION['sid'];
        }else{
            $sid = null;
        }

        // Если идентификатор был найден
        if($sid != null){
            // Массив для обновления времени последнего действия
            $session = array();
            $session['time_last'] = date("Y-m-d H:i:s");

            // Обновление времени последнего действия
            $tableName = TBL_PREF . 'users_sessions';
            $q = "sid = '%s'";
            $where = sprintf($q, $sid);
            $affectedRows = $this->mMysql->update($tableName, $session, $where);


            // Дополнительная проверка наличия сессии (для MySQL)
            if($affectedRows == 0){
                $q = "SELECT count(*) FROM $tableName WHERE sid = '%s'";
                $query = sprintf($q, $sid);
                $result = $this->mMysql->select($query);

                if($result[0]['count(*)'] == 0)
                    $sid = null;
            }
        }

        // Если идентификатор не был найден, но есть куки
        if($sid == null && isset($_COOKIE['login'])){

            // Получение пользователя по логину
            $user = $this->getByLogin($_COOKIE['login']);

            // Если пароли в куках и в базе совпадают
            if($user['password'] == md5(md5($_COOKIE['password'])))

                // Открытие сессии
                $sid = $this->openSession($user['id_user']);
        }

        // Если есть идентификатор, присваивание в поле класса (кэш)
        if($sid != null)
            $this->sid = $sid;

        return $sid;
    }

    /** Создание сессии пользователя в БД
     * @param $id_user - идентификатор пользователя
     * @return mixed SID - идентификатор сессии
     */
    public function openSession($id_user)
    {
        // Генерация случайной строки для идентификатора сессии
        $sid = $this->generateStr(10);

        // Текущее время
        $now = date("Y-m-d H:i:s");

        // Создание массива для внесения в БД
        $session = array();
        $session['id_user'] = $id_user; // id пользователя
        $session['time_start'] = $now;  // Время начала сессии
        $session['time_last'] = $now;   // Время последнего действия
        $session['sid'] = $sid;         // Идентификатор сессии

        // Внесение данных в таблицу сессий пользователей
        $tableName = TBL_PREF . "users_sessions";
        $this->mMysql->insert($tableName, $session);

        // Регистрация SID в Php сессии и возврат SID
        $_SESSION['sid'] = $sid;
        return $sid;
    }

    /** Отчистка сессии
     *
     */
    public function clearSession()
    {
        $tableName = TBL_PREF . "users_sessions";
        $controlTime = date("Y-m-d H:i:s", time() - 60 * 20);
        $q = "time_last < '%s'";
        $where = sprintf($q, $controlTime);

        $this->mMysql->delete($tableName, $where);
    }

    /** Функцияя генерации случайной строки (по умолчаннию - 10 символов)
     * @param int $length - длина строки
     * @return string - случайная строка
     */
    private function generateStr($length = 10)
    {
        // Список возможных символов
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $len = strlen($chars) - 1;

        // Цикл. Пока длинна $code меньше заданной
        while (strlen($code) < $length)

            // Выбираем из строки $chars случайный символ и конкатенируем его в $code
            $code .= $chars[mt_rand(0, $len)];

        return $code;
    }

    /** Проверка привилегий пользователя
     * @param $p_name - имя привилегии
     * @param null $user - пользователь (по умочанию - текущий)
     * @return bool - есть или нет привилегия
     */
    public function can($p_name, $id_user = null)
    {
        // Если пользователь не задан - берем текущего
        if($id_user == null)
            $id_user = $this->getUid();
        // Если нет пользователя возвращаем false
        if($id_user == null)
            return false;

        //Запрос на выборку из базы
        if(!isset($this->privsCache[$p_name][$id_user]))
        $q = "SELECT count(*) FROM " . TBL_PREF ."privs2roles p2r
              LEFT JOIN " . TBL_PREF ."privs p USING(id_priv)
              LEFT JOIN " . TBL_PREF ."users u USING(id_role)
              WHERE u.id_user = '%s'
              AND (p.name = '%s' OR p.name = 'ALL')";
        $query = sprintf($q, $id_user, $p_name);
        $res = $this->mMysql->select($query);

        // Если не нашли привелегию для данного пользователя в базе
        if($res == 0)
            return false;
        // если нашли, возвращаем значение
        return $res[0];
    }
}