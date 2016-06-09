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
        
    ]
	    });
});
</script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 title= "Lista de archivos pdf"><?php echo __('Archivos PDF'); ?></h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Título</th>
					                <th>Descripción</th>
					                <th>Archivo</th>
					            </tr>
					        </thead>
					        <tbody>
					           	<?php foreach ($Downloads as $Report): ?>
									<tr>
								    	<td><?php echo $Report['Download']['title']; ?>&nbsp;</td>
										<td><?php echo $Report['Download']['description']; ?>&nbsp;</td>
										<td class="actions" >
											<?php echo $this->Html->link('Descargar', array('controller' => 'downloads', 'action' => 'viewdown', $Report['Download']['id'],true));?>
										</td>
									</tr>
								<?php endforeach; ?> 

					        </tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>
	<style>
		.dataTables_filter label, .dataTables_filter input {
			float: right;
			line-height: 40px;
		}
	</style>
</div>

