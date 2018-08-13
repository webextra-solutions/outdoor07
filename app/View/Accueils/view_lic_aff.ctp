<script type="text/javascript">
    $(function () { 
        $('#stats1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Licences'
            },
            xAxis: {
                categories: ['']
            },
            yAxis: {
                title: {
                    text: 'Nombre de licences'
                }
            },
            series: [{
                name: '2014',
                data: [<?= $nbLicTotN1+$nbLicPPN1;?>]
            }, {
                name: '2015',
                data: [<?= $nbLicTot+$nbLicPP;?>]
            }]
        }); 
    
        $('#stats2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Structures affiliées'
            },
            xAxis: {
                categories: ['']
            },
            yAxis: {
                title: {
                    text: 'Nombre de structures'
                }
            },
            series: [{
                name: '2014',
                data: [<?= $nbAffTotN1;?>]
            }, {
                name: '2015',
                data: [<?= $nbAffTot;?>]
            }]
        });
    });
</script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Licences & Affiliations en chiffres</h4>
</div>


<div class="modal-body">
<div class="row">
<div class="col-md-6" id="stats1" style="height:300px;"></div>
<div class="col-md-6" id="stats2" style="height:300px;"></div>
</div>

  
</div>
</div>

