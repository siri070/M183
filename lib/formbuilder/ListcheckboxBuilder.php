<?php
/**
 * Created by PhpStorm.
 * User: Wiko
 * Date: 11.06.2018
 * Time: 10:10
 */
class ListcheckboxBuilder extends Builder
{
public function __construct()
{
    $this->addProperty('label');
    $this->addProperty('name');
    $this->addProperty('value', null);
    $this->addProperty('isChecked');
    $this->addProperty('bildId');
    $this->addProperty('tags',null);

}

public function build()
{
    $result = "<label class=\"containerCheckbox\" onclick='removeLabelAndFillDiv('.$this->tags.')'>{$this->label}";
    $result .= "<input name=\"{$this->name}\" value=\"{$this->value}\"  type=\"checkbox\" {$this->isChecked}>";
    $result .= '<span class="checkmarkCheckbox"></span>';
    $result .= '</label>';

    return $result;
}
}
