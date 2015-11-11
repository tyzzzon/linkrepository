<?php
class Header_View
{
    public $menu_ar = array();

    public function render()
    {
        echo '
                        <div class="navbar-header" >
                            <a class="navbar-brand" href = "/user/go_home" > Link repository </a >';
        foreach ($this->menu_ar as $menu_dislocation => $menu_item)
        {
            echo '
                            <a class="navbar-brand" href = "/'.$menu_dislocation.'" id="'.$menu_item['id'].'"> '.$menu_item['value'].'</a >';
        }
        echo '
                        </div>';
    }
}
?>