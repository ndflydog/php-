<?php

include "Decorator.php";
class RenderInJson extends Decorator
{
    public function renderData()
    {
        $output = $this->wrapped->renderData();

        return json_encode($output);
    }
}