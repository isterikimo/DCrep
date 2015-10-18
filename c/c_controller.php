<? //This file is the property of «Duckcode», Russia

abstract class C_Controller
{
    protected $params;

    protected abstract function onInput();
    protected abstract function onOutput();

    /** Последовательность исполнения функций
     * @param $action
     * @param $params
     */
    public function sequencing($action, $params)
    {
        $this->params = $params;
        $this->onInput();
        $this->$action();
        $this->onOutput();
    }

    /** Проверка метода на GET
     * @return bool true - если метод GET
     */
    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /** Проверка метода на POST
     * @return bool true - если метод POST
     */
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /** Генерация HTML в строку
     * @param $path - путь к view файлу
     * @param array $vars - массив переданных переменных
     * @return string - строка html с подставленными переменными
     */
    public function template($path, $vars = array())
    {
        foreach($vars as $key => $val){
            $$key = $val;
        }

        ob_start();
        include "$path";
        return ob_get_clean();
    }

    /** При вызове несуществующего метода генерируем страницу 404
     * @param $name - имя метода
     * @param $params - параметры метода
     */
    public function __call($name, $params)
    {
        $this->page404();
    }

    /** Генерация страницы 404
     *
     */
    public function page404()
    {
        $obj = new C_Page();
        $obj->sequencing('action_404', array());
        die();
    }

    /** Редирект на страницу
     * @param $url - адрес страницы
     */
    protected function redirect($url)
    {
        if($url[0] == "/")
            $url = BASE_URL . substr($url, 1);

        header("location: $url");
        exit();
    }

    /**
     * @param $url
     * @return string
     */
    protected function request($url)
    {
        ob_start();

        if(strpos($url, "http://") === 0 || strpos($url, "https://")){
            echo file_get_contents($url);
        }else{
            $rout = new M_Route($url);
            $rout->request();
        }

        return ob_get_clean();
    }
}