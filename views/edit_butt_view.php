<?php
class Edit_Butt_View
{
    public $action;

    public function render()
    {
        return '<form action="'.$this->action.'"> <button class="btn btn-primary btn-lg">Edit</button></form>';
    }
}