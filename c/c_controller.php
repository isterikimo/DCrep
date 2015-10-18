<?php //This file is property of Duckcode company, Russia.

abstract class C_Controller
{
    //----------Request-------------------------------
    public function request()
    {
        $this->onInput();
        $this->onOutput();
    }

    protected function onInput()
    {
    }

    protected function onOutput()
    {
    }
    //--------------------------------------------------


    //-----------Create template for view-------------
    protected function template($path, $vars = array())
    {
        foreach($vars as $key => $value){
            $$key = $value;
        }

        ob_start();
        include $path;

        return ob_get_clean();
    }
    //--------------------------------------------------

    //---------Method verification-------------------
    protected function isPost()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

    protected function isGet()
    {
        return $_SERVER["REQUEST_METHOD"] == "GET";
    }
    //-------------------------------------------------
}