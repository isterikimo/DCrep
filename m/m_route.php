<? //This file is the property of «Duckcode», Russia

class M_Route
{
    private $controller;
    private $action;
    private $params;

    function __construct($url)
    {
        $query = explode('/', $url);
        $this->params = array();

        foreach($query as $par){
            $this->params[] = $par;
        }

        if(empty($this->params))
            $this->params[0] = null;

        $this->action = 'action_';
        $this->action .= (!empty($this->params[1])) ? $this->params[1] : "index";

        switch($this->params[0]){
            case "page":
                $this->controller = "C_Page";
                break;
            case "pages":
                $this->controller = "C_Pages";
                break;
            case "articles":
                $this->controller = "C_Articles";
                break;
            case "news":
                $this->controller = "C_News";
                break;
            case "texts":
                $this->controller = "C_Texts";
                break;
            case "docs":
                $this->controller = "C_Docs";
                break;
            case "gallery":
                $this->controller = "C_Gallery";
                break;
            case "login":
                $this->controller = "C_Auth";
                $this->action = "action_login";
                break;
            case "users":
                $this->controller = "C_Users";
                break;
            case "auth":
                $this->controller = "C_Auth";
                break;
            case "menu":
                $this->controller = "C_Menu";
                break;
            case null:
                $this->controller = "C_Page";
                $this->action = "action_index";
                break;
            default:
                $this->controller = "C_Page";
                $this->action = "action_index";
        }
    }

    /** Формирование запроса
     *
     */
    public function request()
    {
        $c = new $this->controller;
        $c->sequencing($this->action, $this->params);
    }
}