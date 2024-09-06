<?php
$js = <<< ZZZZZ
    (function ($) {    
        $('#test-add-user').submit(function (e) {
            e.preventDefault();
            
            var family = $('#clients-family').val();
            
            $.get("index.php?r=test/ajax-save", {family}, function(res) {
                console.log(res);
            });
        });
    })(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<style>
    table{
        width: 100%;
    }
    td{
        padding: 3px;
        border: 1px solid grey;
    }
</style>


<?php
echo '<br>';
// echo time();
$datetime = date('d.m.Y H:i:s');
$datetime = strtotime($datetime);
echo $datetime;

?>

<br><br><br>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Добавить тест клиента
</button>

<br><br>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    echo $this->render("/../modules/admin/views/clients/_form.php", ['model' => $model]);
                ?>
            </div>
        </div>
    </div>
</div>

<table>
    <tr>
        <td>ID</td>
        <td>family</td>
    </tr>
    <?php
    foreach ($clients as $client){
        echo "<tr>";
        echo "<td>{$client['id']}</td>";
        echo "<td>{$client['family']}</td>";
        echo "</tr>";
    }
    ?>
</table>