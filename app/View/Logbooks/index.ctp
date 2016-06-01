<script>
	$(document).ready(function() {
	    $('#example').DataTable( {
	         dom: 'Bfrtip',
	         colReorder: true,
    buttons: [
        'colvis',
        'print',
        'excel', 
        'pdf',
        'copy',
        
    ]
	    });
});
</script>
<?php if($_SESSION['role']=='Administrador'): ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">

			<h2 title= "Bitácora con los cambios hechos sobre el catálogo"><?php echo __('Bitácora de cambios'); ?></h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Usuario</th>
					                <th>Nombre del usuario</th>
					                <th>Descripción del cambio</th>
					                <th>Fecha de modificación</th>
					            </tr>
					        </thead>
					        <tbody>
					            <?php foreach ($logbooks as $logbook): ?>
												<tr>
													<td><?php echo h($logbook['User']['username']); ?>&nbsp;</td>
													<td><?php echo h($logbook['User']['name']." ".$logbook['User']['lastname1']." ".$logbook['User']['lastname2']); ?>&nbsp;</td>
													<td><?php echo h($logbook['Logbook']['description']); ?>&nbsp;</td>
													<td><?php echo substr(h($logbook['Logbook']['modified']),0,10)." a las ".substr(h($logbook['Logbook']['modified']),10); ?>&nbsp;</td>
												</tr>
										<?php endforeach; ?>
					            
					        </tbody>
					    </table>
				</div>
				<style>
					.dataTables_filter label, .dataTables_filter input {
						float: right;
						line-height: 40px;
					}
				</style>
			</div>
		</div>
	</div>
	
</div>
<?php endif; ?>