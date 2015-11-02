<?php
class Main_View
{
    public $ar = array();
    public function render($view_name)
    {
        $view_header = new Header_View();
        $view_header->render($_SESSION['is_signed']);

        $class_name = ucfirst(trim($view_name, "/"))."_View";
        if(class_exists($class_name))
        {
            $view_content = new $class_name;
            $view_content->render();
        }
        else
            Route::ErrorPage404();
//        echo '<div class="header">' . $view->header_view->render() . '</div>';
//        echo '<div class="content">' . $view->content_view->render() . '</div>';
//        echo '<div class="footer">' . $view->footer_view->render() . '</div>';
//        require_once "header_view.php";
//        require_once "footer_view.php";

        $view_footer = new Footer_view();
        $view_footer->render();
    }
}
?>