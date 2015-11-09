<?php
class Edit_Butt_View
{
    public $user_login;

    public function render()
    {
        return '<form action="/user/edit_view/'.$this->user_login.'"> <button class="btn btn-primary btn-lg">Edit</button></form>';
    }
}