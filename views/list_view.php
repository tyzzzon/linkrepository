<?php
class List_View
{
    public $table_head = array();
    public $table_body = array();
    public $edit_butt = array();
    public $delete_butt = array();
    public $delete_url;

    public function render()
    {
        echo '
<script type="text/javascript">var target_url = "'.$this->delete_url.'";</script>
<script type="text/javascript" src="/js/delete.js"></script>
<table id="tablo" class="table table-striped">
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
        $i = 0;
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
            echo '<th>'
                .$this->edit_butt[$i]->render().'
            </th>';
            echo '<th>'
                .$this->delete_butt[$i]->render().'
            </th>';
        echo '</tr>';
            $i++;
        }
        echo '
    </tbody>
</table>
';

echo'
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
           <p></p>
        </div>
        <div class="modal-footer">
           <a id="dele" role = "button" class="btn btn-primary btn-lg" data-dismiss="modal">Delete</a>
           <a class="btn btn-primary btn-lg" role = "button" data-dismiss="modal">Close</a>
        </div>
     </div>
  </div>
</div>


';
    }
}
?>
