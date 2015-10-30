<?php
require_once "header.php";
?>

<table class="table table-striped">
    <?php
        $links = new Link_Controller();
        $links->link_look(1);
    ?>
</table>

<?php
require_once "footer.php";
?>
