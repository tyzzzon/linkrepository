<?php
class Main_View
{
    public function render()
    {
        echo '<div class="header">' . $view->header_view->render() . '</div>';
        echo '<div class="content">' . $view->content_view->render() . '</div>';
        echo '<div class="footer">' . $view->footer_view->render() . '</div>';
//        require_once "header.php";
//        require_once "footer.php";
    }
}
?>