<? //This file is the property of «Duckcode», Russia

class M_Menu
{
    public static $instance;
    public $mMysql;

    public static function instance()
    {
        if(self::$instance == null)
            self::$instance = new M_Menu();

        return self::$instance;
    }
}