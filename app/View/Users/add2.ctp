
<div class='titre-bloc'>Créer un compte</div>
<div class='bloc'>

<?= $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'label' => array(
                'class' => 'col col-md-3 control-label'
            ),
            'wrapInput' => 'col col-md-9',
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    )); ?>

  <?php 
        echo $this->Form->input('username', array('label'=>'Identifiant :'));
        echo $this->Form->input('password', array('label'=>'Mot de passe :'));   ?>

        <div class="form-group">
        <?php echo $this->Form->submit('Se connecter', array(
            'div' => 'col col-md-9 col-md-offset-3',
            'class' => 'btn btn-success'
        )); ?>
    </div>

        <?   
    echo $this->Form->end();
  ?>
</div>