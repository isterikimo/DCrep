<?php //This file is property of Duckcode company, Russia.

class C_News extends C_Base
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

                if(isset($_POST["new"])){
                    //
                    // Добавление
                    // Действия при нажатии кнопки "Опубликовать" в v/v_news.php
                    //

                    // Добавление новости через интерфейс класса статей
                    $this->mArticle->add("dckc_news", $title, $content, $action);

                    header("location: index.php?c=news");
                }
            } else{
                $title = strip_tags(trim($_POST["title"]));
                $content = trim($_POST["content"]);
                $action = $_POST["action"];

                return true;
            }
        }

        $this->title .= " :: Новости";
        $this->news = $this->mArticle->getAll("news");
    }

    protected function onOutput()
    {
        $this->content = $this->template("v/v_news.php", array("news" => $this->news));
        parent::onOutput();
    }
}