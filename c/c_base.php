<? //This file is the property of «Duckcode», Russia

class C_Base extends C_Controller
{
    protected $title;       // Заголовок страницы
    protected $content;     // Содержание страницы
    protected $description; // Описание страницы (SEO)
    protected $keywords;    // Ключевые слова (SEO)
    protected $user;        // Авторизованный пользователь
    protected $needLogin;   // Необходима ли авторизация
    protected $adminLink;   // Ссылка на панель админа, для залогиненных
    protected $topMenu;     // Верхнее меню
    protected $leftMenu;    // Левое меню
    protected $styles;      // Стили
    protected $scripts;     // Скрипты

    /** Значенияя по умолчанию
     * Могут быть изменены в наследуемых контроллерах
     */
    function __construct()
    {
        $this->needLogin = false; // По умолчанию не требуется
        $this->user = M_Users::instance()->get();
        $this->adminLink = false; // По умолчанию не отображается
        $this->title = '';
        $this->keywords = '';
        $this->description = '123345';
        $this->topMenu = null;
        $this->leftMenu = null;
        $this->styles = array("style", "fonts");
        $this->scripts = null;
    }

    /** Обработка входящих данных
     *
     */
    public function onInput()
    {
        if($this->needLogin && $this->user === null)
            $this->redirect('/auth/login');

        if(M_Users::instance()->can('PAGES')){
            $this->adminLink = true;
        }

        $this->title = 'Happy Kids. Логопедический центр';
        $this->content = '';
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
            'keywords' => $this->keywords,
            'description' => $this->description,
            'topMenu' => $this->topMenu,
            'leftMenu' => $this->leftMenu,
            'styles' => $this->styles,
            'scripts' => $this->scripts);

        $page = $this->template('v/base_templates/' . MAIN_TEMPLATE, $vars);
        echo $page;
    }

}