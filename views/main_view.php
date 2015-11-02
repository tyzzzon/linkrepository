<?php
class Main_View
{
    public $ar = array();
    public function render()
    {
        $view_header = new Header_View();
        $view_header->render(false);

        $class_name = ucfirst(trim($_SERVER["REQUEST_URI"], "/"))."_View";
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