<?php //This file is property of Duckcode company, Russia.

class C_SingleNews extends C_Base
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
        $id_news = $_GET['id'];

        $this->news = $this->mArticle->get("news", $id_news);

        //
        // Изменение/Удаление новостей
        //

        if($this->isPost()) // Добавить проверку на администратора!!!
        {
            if(isset($_POST['del'])){
                //
                // Удаление
                // Действия при нажатии кнопки "Удалить" в v_singlenews.php
                //
                $id_news = abs(trim((int)$_POST["id_news"]));

                // Удаление новости через интерфейс класса статей
                $this->mArticle->del("dckc_news", $id_news);

                header("location: index.php?c=news");
            }

            if(!empty($_POST['title']) and !empty($_POST['content'])){
                $id_news = $_POST['id'];
                $title = strip_tags(trim($_POST["title"]));
                $content = trim($_POST["content"]);
                $action = $_POST["action"];

                //
                // Редактирование
                // Действия при нажатии кнопки "Опубликовать" в v_newnews.php
                //
                $this->mArticle->edit();

                header("location: index.php?c=news");
            } else{
                $title = strip_tags(trim($_POST["title"]));
                $content = trim($_POST["content"]);
                $action = $_POST["action"];

                return true;
            }
        }
    }

    protected function onOutput()
    {
        $this->title .= " :: Новость";
        $this->content = $this->template("v/v_singlenews.php", array("news" => $this->news));
        parent::onOutput();
    }
}