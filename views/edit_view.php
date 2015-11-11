<?php
class Edit_View
{
    public $field_ar = array();
    public $bool_par;
    public $action;

    public function render()
    {
        echo '
        <div class = "jumbotron" >
            <div class = "container" >
                <h1 > Editing!</h1 >
                <p ><form class = "navbar-form navbar-left" action = "'.$this->action.'" method = "post" >';
        foreach ($this->field_ar as $field_name => $field_text)
            echo '
                    <div class = "form-group" >
                        '.$field_name.': <input type = "text" name = "'.$field_name.'" value = "'.$field_text.'" class = "form-control" >
                    </div >
                    <br >';
        if (isset($this->bool_par))
        {
            echo '<div class = "form-group" >Private status: <input type="checkbox" name="Link private status" class = "form-control"';
            if ($this->bool_par)
                echo ' checked';
            echo '></div><br>';
        }
        echo '
                    <button type = "submit" name = "ok" class = "btn btn-success" > Edit </button >
                </form ></p >
            </div >
        </div >';
    }
}