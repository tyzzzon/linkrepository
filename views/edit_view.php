<?php
class Edit_View
{
    public $field_ar = array();

    public function render()
    {
        echo '
        <div class = "jumbotron" >
            <div class = "container" >
                <h1 > Editing!</h1 >
                <p ><form class = "navbar-form navbar-left" action = "/user/edit" method = "post" >';
        foreach ($this->field_ar as $field_name => $field_text)
            echo '
                    <div class = "form-group" >
                        '.$field_name.': <input type = "text" name = "'.$field_name.'" value = "'.$field_text.'" class = "form-control" >
                    </div >
                    <br >';
        echo '
                    <button type = "submit" name = "ok" class = "btn btn-success" > Edit </button >
                </form ></p >
            </div >
        </div >';
    }
}