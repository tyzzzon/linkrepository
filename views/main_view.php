<?php
class Main_View
{
    public $ar = array('is_signed' => false);
    public $header_ar = array(
            'user/go_home' => array(
                'value' => 'Home',
                'id'=>'home-link'),
            'link/list/1' => array(
                'value' => 'Links',
                'id' => 'list-link'),
            'user/reg_view' => array(
                'value' => 'Registration',
                'id' => 'reg-link'),
            'user/auth_view' => array(
                'value' => 'Authentication',
                'id' => 'auth-link'));
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
                <link href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css" rel = "stylesheet" >
                <style type = "text/css" > body
                {
                    padding-top:50px;
                    padding-bottom:40px;
                }
                </style >
                <script src="/js/jquery-1.11.3.js"></script>
                <script src = "/js/bootstrap.min.js" ></script>
                <script src="/js/logout.js"></script>

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

        $view_footer = new Footer_view();
        $view_footer->render();
        echo '</body>
</html>';
    }
}
?>