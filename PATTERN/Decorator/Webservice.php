<?php

include 'RendererInterface.php';
class Webservice implements RendererInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function renderData()
    {
        return $this->data;
    }
}