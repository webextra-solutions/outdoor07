<script type="text/javascript">// JavaScript POUR - Events/view.cyp
  $(function() {
    // RECHERCHER UN PARTICIPANT
    $('#search-pratiquants').autocomplete({
      minLength    : 1,
      source        : serveur+'/pratiquants/searchPratiquant',
      select:  function(event, ui) { 
       window.location.href = serveur+'/pratiquants/view/'+ui.item.id+'/general';
      } 
    });
  });
</script>




      <table cellspacing="0">
           

            <?php foreach ($personne['PersonnesSeance'] as $row): ?>

              <tr>

              <td width="35px">
                <? if($row['presence'] == 1){?><i class="glyphicons user gly_vert x2" title="Sera présent"></i><? }?>
                <? if($row['presence'] == 2){?><i class="glyphicons user gly_rouge x2" title="Sera absent"></i><? }?>
                <? if(empty($row['presence'])){?><i class="glyphicons user gly_off x2" title="pas de réponse"></i><? }?></td>
              <td width="35px">
                <? if($row['presence_eff'] == 1){?><i class="glyphicons user gly_vert x2" title="Présent"></i><? }?>
                <? if($row['presence_eff'] == 2){?><i class="glyphicons user gly_rouge x2" title="Absent"></i><? }?>
                <? if(empty($row['presence_eff'])){?><i class="glyphicons user gly_off x2" title="En attente"></i><? }?></td>
              

               <td width="200" class="lien" onclick="document.location='<?= serveur;?>/seances/view/<?= $row['seance_id'];?>'" >Séance n°<?= $row['Seance']['num']; ?> • <?= $row['Seance']['date']; ?></td>
               <td width="110"><?= $this->Listes->typePersonne($row['type']); ?></td>
               <td><?= $this->Listes->groupEcole($row['groupe']); ?></td>
              
               <td align="right" width="30"> 
                          <?php echo $this->Html->link('<i class="glyphicons zoom_in"></i> ', 
                              array('controller' => 'seances', 'action' => 'view', $row['seance_id'], 'general'), 
                              array('class'=>'btn btn-default btn-xs','escape' => false, 'title' => 'voir / modifier', 'data-toggle'=>'tooltip', 'data-placement'=>'left')
                          );?>
                      </td>

            
          
            </tr>
            <?php endforeach; ?>

           

          
          
      </table>


