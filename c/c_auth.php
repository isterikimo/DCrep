<? //This file is the property of «Duckcode», Russia

class C_Auth extends C_Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function onInput()
    {
        parent::onInput();
    }
    public function action_login()
    {
        $this->title .= ":: Авторизация";
        $mUsers = M_Users::instance();

        if($this->isPost()){
            if(isset($_POST['enter'])){
                if($mUsers->login($_POST['login'], $_POST['password'], $_POST['name'], isset($_POST['remember'])))
                    $this->redirect("/pages");
            }else{
                $mUsers->logout();
                $this->redirect("/login");
            }
        }

        $this->content = $this->template("v/v_login.php", array());
    }

}