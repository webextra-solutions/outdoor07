<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-star" style="color:#F00;" title="priorité haute"></i> <b><?= $news['Article']['name'];?></b></h4>
</div>

<?= $this->Form->create('Article', array(
    'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
        'class' => 'col col-md-3 control-label'
    ),
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control input-sm'
    ),
    'class' => 'form-horizontal'
    )); 
?>

<div class="modal-body">
    <?= $news['Article']['details'];?>

   
</div>


</div>

