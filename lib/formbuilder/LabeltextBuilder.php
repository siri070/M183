<?php

class LabeltextBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('value', null);
    }

    public function build()
    {
        $result = '<div class="form-group">';
        $result .= "    <label class=\"col-md-2 control-label\" >{$this->label}</label>";
        $result .= '    <div class="col-md-4">';
        $result .= "    <label class=\"col-md-2 control-label\" >{$this->value}</label>";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}