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
			<h2 title= "Lista de archivos pdf"><?php echo __('Enlaces'); ?></h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Título</th>
					                <th>Enlace</th>
					                <th>Descripción</th>
					                <th>Comentario</th>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php foreach ($links as $link): ?>
									<tr>
										<td><?php echo h($link['Link']['title']); ?>&nbsp;</td>
										<td class="actions" >
											<?php echo $this->Html->link($link['Link']['url']);?>
										</td>
										<!--<td><?php echo h($link['Link']['url']); ?>&nbsp;</td>-->
										<td><?php echo h($link['Link']['description']); ?>&nbsp;</td>
										<td><?php echo h($link['Link']['relatedpage']); ?>&nbsp;</td>
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






