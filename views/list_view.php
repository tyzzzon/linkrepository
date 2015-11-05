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
    }
}
?>
