<? //This file is the property of «Duckcode», Russia

class C_Pages extends C_Admin_Base
{
    public function onInput()
    {
        parent::onInput();
    }

    /** Отображение всех страниц
     *
     */
    public function action_index()
    {
        $this->title .= " :: Все страницы";
        $this->content = $this->template("v/pages/v_all.php", array());
    }

    /** Добавление страницы
     *
     */
    public function action_add()
    {
        $this->title .= " :: Добавление страницы";
        $this->content = $this->template("v/pages/v_add.php", array());
    }
    public function action_edit()
    {
        $this->title = " :: Редактирование страницы";
    }

    public function onOutput()
    {
        parent::onOutput();
    }
}