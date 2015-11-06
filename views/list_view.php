<?php
class List_View
{
    public $table_head = array();
    public $table_body = array();
    public $id_ar = array();

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
        $i = 0;
        foreach ($this->table_body as $body_row)
        {
            echo '
        <tr id="row'.$i.'" class = "'.$this->id_ar[$i].'">';
            foreach ($body_row as $body_item)
            {
                echo '
            <th>'
                .$body_item.'
            </th>';
            }
            echo '
        </tr>';
            $i++;
        }
        echo '
    </tbody>
</table>

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
           <a href = "/user/users_list/" id="dele" role = "button" class="delete" data-dismiss="modal">Delete</a>
           <a class="btn btn-primary btn-lg" role = "button" data-dismiss="modal">Close</a>

        </div>
     </div>
  </div>
</div>

<script>
document.onclick = function( e )
{
    if ( e.target.tagName = "BUTTON")
    {
    var re = /o/;
    var str = dele.getAttribute("role");
    var ar = str.split(re);
    alert( "eiopryje059hyjepoihnjeopi");
    }
}
</script>
<!--        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->';
    }
}
?>
