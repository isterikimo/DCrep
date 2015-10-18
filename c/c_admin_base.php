<? //This file is the property of «Duckcode», Russia

class C_Admin_Base extends C_Controller
{
    protected $title;       // Заголовок страницы
    protected $content;
    protected $user;        // Авторизованный пользователь
    protected $needLogin;   // Необходима ли авторизация
    protected $styles;      // Стили
    protected $scripts;     // Скрипты

    /** Значенияя по умолчанию
     * Могут быть изменены в наследуемых контроллерах
     */
    function __construct()
    {
        $this->needLogin = true; // По умолчанию требуется
        $this->user = M_Users::instance()->get();
        $this->title = 'Панель администратора';
        $this->content = '';
        $this->styles = array("bootstrap", "fonts", "admstyle");
        $this->scripts = array("jquery", "bootstrap");
    }

    /** Обработка входящих данных
     *
     */
    public function onInput()
    {
        if($this->needLogin && $this->user === null)
            $this->redirect('/auth/login');

        $this->title = 'Панель администратора';
    }

    /** Значения на выходе, при отрисовке макета
     *
     */
    public function onOutput()
    {
        $url = implode('/', $this->params);
        $mMenu = M_Menu::instance();

        $vars = array(
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'styles' => $this->styles,
            'scripts' => $this->scripts);

        $page = $this->template('v/v_admin.php', $vars);
        echo $page;
    }

}