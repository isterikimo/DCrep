<? //This file is the property of «Duckcode», Russia

class C_Page extends C_Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function onInput()
    {
        parent::OnInput();
    }

    public function action_index()
    {
        $url = implode('/', $this->params);

        if($url == '')
            $url == 'home';

       /* $mPages = M_Pages::instance();
        $page = $mPages->getByUrl($url);*/
    }
}