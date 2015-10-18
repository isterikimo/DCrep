<?php //This file is property of Duckcode company, Russia.

class C_Articles extends C_Base
{
    private $mArticles;

    private function __construct()
    {
        $this->mArticles = M_Articles::getInstance();
    }

    protected function onInput()
    {
        parent::onInput();
        $this->title .= " :: ������";

        $articles = $this->mArticles->getAll();
    }

    protected function onOutput()
    {
        parent::onOutput();
    }
}