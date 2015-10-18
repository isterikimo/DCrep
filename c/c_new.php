<?php //This file is property of Duckcode company, Russia.

class C_New extends C_Base
{
    private $news;
    private $mArticle;

    public function __construct()
    {
        $this->mArticle = M_Article::getInstance();
    }

    protected function onInput()
    {
        parent::onInput();

        $this->title .= " :: Добавление Новости";

        //
        // Добавление\Измененине\Удаление новостей
        //

        if($this->isPost()) // Добавить проверку на администратора!!!
        {
            //
            // Проверка на заполненность полей
            //

            if(!empty($_POST['title']) and !empty($_POST['content'])){
                $title = strip_tags(trim($_POST["title"]));
                $content = trim($_POST["content"]);
                $action = $_POST["action"];

                $title = ru2en($title);
                //
                // Добавление
                // Действия при нажатии кнопки "Опубликовать" в v/v_news.php
                //

                // Добавление новости через интерфейс класса статей
                $this->mArticle->add("dckc_news", $title, $content, $action);

                header("location: index.php?c=news");
            } else{
                $title = strip_tags(trim($_POST["title"]));
                $content = trim($_POST["content"]);

                if(isset($_POST["action"]))
                    $action = "checked";

                $this->news = array("title" => $title, "content" => $content, "action" => $action);

                return true;
            }
        } else{
            $title = strip_tags(trim($_POST["title"]));
            $content = trim($_POST["content"]);
            $action = $_POST["action"];

            $this->news = array("title" => $title, "content" => $content, "action" => $action);
        }
    }

    protected function onOutput()
    {
        $this->content = $this->template("v/v_new.php", array("news" => $this->news));
        parent::onOutput();
    }
}