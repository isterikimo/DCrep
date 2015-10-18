<?php //This file is property of Duckcode company, Russia.

class C_About extends C_Base
{
    protected function onInput()
    {
        parent::onInput();
        $this->title .= " :: � ��������";
    }

    protected function onOutput()
    {
        parent::onOutput();
    }
}