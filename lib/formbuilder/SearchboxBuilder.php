<?php
/**
 * Created by PhpStorm.
 * User: Wiko
 * Date: 11.06.2018
 * Time: 17:48**/

class SearchboxBuilder extends Builder
{
    public function __construct()
    {
        $this->addProperty('label');
        $this->addProperty('namebutton');
        $this->addProperty('name');
        $this->addProperty('value', null);
        $this->addProperty('confirm', null);
    }

    public function build()
    {
        $result = '<div class="form-group" >';
        $result .= '    <div style="float: right" class="search-container col-md-5">';
        $result .= "        <input style='float: right' name=\"{$this->namebutton}\" type=\"submit\" class=\"btn btn-primary\" value=\"{$this->label}\"  >";
        $result .= "        <input id='search'  autocomplete=\"off\" type=\"text\" value='' name=\"{$this->name}\" placeholder=\"{$this->value}\" class=\"form-control input-md\">";
        $result .= '    </div>';
        $result .= '</div>';

        return $result;
    }
}

