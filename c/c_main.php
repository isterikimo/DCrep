<?php //This file is property of Duckcode company, Russia.

class C_Main extends C_Base
{
    protected function onInput()
    {
        parent::onInput();
        $this->title .= " :: Главная";
		$this->menuItem = array("<a href='/index.php'>Главная</a>",
            "<a href='/index.php?c=news'>Новости</a>",
            "<a href='/index.php?c=services'>Услуги</a>",
            "<a href='/index.php?c=portfolio'>Портфолио</a>",
            "<a href='/index.php?c=about'>О компании</a>",
            "<a href='/index.php?c=contacts'>Контакты</a>");
    }

    protected function onOutput()
    {
		$this->content = $this->template('v/v_startpage.php', array("menu" => $this->menuItem));
        parent::onOutput();
		
    }
}