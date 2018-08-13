<script type="text/javascript">// JavaScript POUR - Events/view.cyp
  $(function() {
    // RECHERCHER UN PARTICIPANT
    $('#search-participants').autocomplete({
      minLength    : 1,
      source        : serveur+'/participants/searchParticipant',
      select:  function(event, ui) { 
       window.location.href = serveur+'/participants/view/'+ui.item.id+'/general';
      } 
    });
  });
</script>

<?// Formualire AJAX 
$data = $this->Js->get('#ParticipantForm')->serializeForm(array('isForm' => true, 'inline' => true));



$this->Js->get('#ParticipantForm')->event(
   'submit',
   $this->Js->request(
    array('action' => 'viewGestion/'.$event['Event']['id'].'/participants', 'controller' => 'events'),
    array(
        'update' => '#contentAcred',
        'data' => $data,
        'async' => true,    
        'dataExpression'=>true,
        'method' => 'POST'

    )
  )
);


?>



 
<? if(count($participants)  != 0){?>

  <table cellspacing="0">
        <tr>
          <th></th>
          
        <th>Nom/Prénom</th>
        <th>Délégation</th>
        <th></th>
        <th></th>
       </tr>
        <?php foreach ($participants as $row): ?>

              <tr>
              <td width="25"><i class="glyphicons chevron-right"></i></td>
           

           <td width="300" class="lien" onclick="document.location='<?= serveur;?>/participants/view/<?= $row['Participant']['id'];?>'" ><?= $row['Personne']['NF']; ?></td>
           <td ><? if($row['Participant']['delegation_id'] != 0){ echo $row['Delegation']['name'];} ?></td>   
          
           <td align="right" width="30"> 
                      <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                          array('controller' => 'participants', 'action' => 'view', $row['Participant']['id']), 
                          array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                      );?>
                  </td>

        
        <td align="right" width="30"> 
              <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
            array('action' => 'deleteParticipant',  $row['Participant']['id'], $row['Participant']['event_id']), 
            array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
            'Etes-vous sûr de vouloir supprimer ce participant ?'
          );?></td>   
        </tr>
        <?php endforeach; ?>
      </table>








<? } else {?>
    Aucun participant n'est affecté pour le moment.<br/><br/>
<? }?>









