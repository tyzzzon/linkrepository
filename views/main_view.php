<?php
class Main_View
{
    public $ar = array('is_signed' => false);

    public function render($view_name)
    {
        echo '
        <!DOCTYPE html >
        <html lang = "en" >
            <head >
                <meta charset = "utf-8" >
                <meta http-equiv = "X-UA-Compatible" content = "IE=edge" >
                <meta name = "viewport" content = "width=device-width, initial-scale=1" >
                <meta name = "description" content = "" >
                <meta name = "author" content = "" >
                <title > Main page </title >
                <link href = "/css/bootstrap.min.css" rel = "stylesheet" >
                <style type = "text/css" > body
                {
                    padding-top:50px;
                    padding-bottom:40px;
                }
                </style >
                <!--<script src = "/js/bootstrap.min.js" ></script>-->
            </head >
            <body>';
        $view_header = new Header_View();
        $view_header->is_signed = $this->ar['is_signed'];
        $view_header->render();

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
        echo '</body>
</html>';
    }
}
?>