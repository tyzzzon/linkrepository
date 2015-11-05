<?php
class Main_View
{
    public $ar = array('is_signed' => false);
    public $header_ar = array('Home' => 'user/go_home', 'Links' => 'link/link_look/1',
        'Registration' => 'user/registration_view', 'Authentication' => 'user/auth_view', 'User list' => 'user/users_list',
        'User edit' => 'user/edit_view/name', 'Link edit' => 'link/edit_view/vk.com');
    public $content_view;

    public function render()
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
                <link href = "/css/bootstrap.css" rel = "stylesheet" >
                <style type = "text/css" > body
                {
                    padding-top:50px;
                    padding-bottom:40px;
                }
                </style >
                <script src="/js/jquery-1.11.3.js"></script>
                <script src = "/js/bootstrap.min.js" ></script>

            </head >
            <body>
            <nav class="navbar navbar-inverse navbar-fixed-top" >
                    <div class="container" >';

        $view_header = new Header_View();
        $view_header->menu_ar = $this->header_ar;
        $view_header->render();
        echo '      </div>
            </nav>';

        $this->content_view->render();

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