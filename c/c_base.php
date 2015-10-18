<?php //This file is property of Duckcode company, Russia.

abstract class C_Base extends C_controller
{
    protected $title;
    protected $menu;
    protected $attic;
    protected $footer;
    protected $content;

    protected function onInput()
    {
        $this->title = "Happy Kids";
    }

    protected function onOutput()
    {
        $this->attic = $this->template("v/v_header.php");
        $this->footer = $this->template("v/v_footer.php");

        $page = $this->template("v/v_main.php", array("title"   => $this->title,
                                                      "header"  => $this->attic,
                                                      "content" => $this->content,
                                                      "footer"  => $this->footer));

        echo $page;

    }
}