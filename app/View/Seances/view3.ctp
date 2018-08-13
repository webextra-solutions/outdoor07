<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-star" style="color:#F00;" title="priorité haute"></i> <b><?= $news['Article']['name'];?></b></h4>
</div>

<?= $this->Form->create('Article', array('action' => 'skipPopupProfil'));?>

<div class="modal-body">
    <?= $news['Article']['details'];?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Fermer</button>
    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicons bin"></i> Ne plus afficher ce message</button><?php echo $this->Form->end(); ?>

</div>


</div>

