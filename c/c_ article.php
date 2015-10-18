<?php //This file is property of Duckcode company, Russia.

class C_Article extends C_Base
{
    private $test;

    protected function onInput()
    {
        parent::onInput();
        $this->title .= " :: ������";
        $this->test = "������";
        $this->content = $this->template("v/v_article.php", array("test" => $this->test));

    }

    protected function onOutput()
    {
        parent::onOutput();
    }
}