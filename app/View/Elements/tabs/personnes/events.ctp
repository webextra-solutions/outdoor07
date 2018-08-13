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


    // BOITE DE DIALOGUE - Voir Stat
    $(".events").click(function(){
            $("#voirEvent").modal();
            $.get(serveur+'/personnes/viewEvent',{id : $(this).attr("rel")},function(data){
            $('#ajaxDataEvent').empty().append(data);
        });
        return false;
    });
  });
</script>

  <div class="alert alert-info">Cette section vous permet d'ajouter un événement concernant cette personne. (Probléme,...)</div>




      <table cellspacing="0">
           

            <?php foreach ($personne['Event'] as $row): ?>

              <tr>

              <td width="35px"><i class="glyphicons chevron-right"></i></td>
              

               <td   class="lien events" rel="<?= $row['id']; ?>" ><?= $row['name']; ?></td>

                <td width="30"><button type="button" class="btn btn-default btn-xs events" rel="<?= $row['id']; ?>"><i class="glyphicons zoom_in"></td>
             
              
              <td align="right" width="30"> 
                  <?php echo $this->Html->link('<i class="glyphicons bin"></i> ', 
                array('action' => 'deletePersonneEvent',  $row['id'], $row['personne_id']), 
                array('class'=>'btn btn-danger btn-xs','escape' => false, 'title' => 'supprimer', 'data-toggle'=>'tooltip', 'data-placement'=>'left'),
                'Etes-vous sûr de vouloir supprimer cet évenement pour cette personne ?'
              );?></td>

            
          
            </tr>
            <?php endforeach; ?>

           

          
          
      </table>


<!-- BOITE DE DIALOGUE - VOIR Event -->
<div class="modal fade bs-example-modal-md" tabindex="-1" id="voirEvent" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content" id="ajaxDataEvent"></div>       
  </div> 
</div>