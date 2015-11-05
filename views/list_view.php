<?php
class List_View
{
    public $table_head = array();
    public $table_body = array();

    public function render()
    {
        echo '
<table class="table table-striped">
    <thead>
        <tr>';
        foreach($this->table_head as $head_item)
        {
            echo '
            <th>'
                .$head_item.'
            </th>';
        }
        echo '
        </tr>
    </thead>
    <tbody>';
        foreach ($this->table_body as $body_row)
        {
            echo '
        <tr>';
            foreach ($body_row as $body_item)
            {
                echo '
            <th>'
                .$body_item.'
            </th>';
            }
            echo '
        </tr>';
        }
        echo '
    </tbody>
</table>';

//<div id="myModal" class="modal fade" role="dialog">
//  <div class="modal-dialog">
//     <div class="modal-content">
//        <div class="modal-header">
//           <button type="button" class="close" data-dismiss="modal">&times;</button>
//           <h4 class="modal-title">Modal Header</h4>
//        </div>
//        <div class="modal-body">
//           <p></p>
//        </div>
//        <div class="modal-footer">
//           <a class="btn btn-primary btn-lg" href = "/user/delete/" role = "button" data-dismiss="modal">Close</a>
//        </div>
//     </div>
//  </div>
//</div>';
var_dump($_REQUEST);
    }
}
?>
