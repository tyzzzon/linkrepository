<?php
class Delete_Butt_View
{
    public $user_id;
    public function render()
    {
        return '<button class="btn btn-primary btn-lg" user_id="'.$this->user_id.'" butt_class="dele" data-toggle="modal" data-target="#myModal">Delete</button>';
    }
}