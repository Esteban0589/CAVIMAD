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
			<h2 title= "Lista de archivos pdf"><?php echo __('Archivos PDF'); ?>
				<?php if($this->Session->read('role') =='Administrador'): ?>
					<?php echo $this->Html->link(__('Agregar documento'), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar documento', 'style'=>'color: #3891D4;    font-size:25px; padding: 5px;')); ?>
				 <?php endif; ?>
			 </h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Título</th>
					                <th>Descripción</th>
					                <th>Resumen</th>
					                <th>Archivo</th>
					                <?php if($this->Session->read('role') =='Administrador'): ?>	
					                	<th>Acciones</th>
					                <?php endif;?>
					                
					            </tr>
					        </thead>
					        <tbody>
					           	<?php foreach ($Downloads as $Report): ?>
									<tr>
								    	<td><?php echo $Report['Download']['title']; ?>&nbsp;</td>
										<td><?php echo $Report['Download']['description']; ?>&nbsp;</td>
										<td><?php echo $Report['Download']['abstract']; ?>&nbsp;</td>
										<td class="actions" >
											<?php echo $this->Html->link(__(''), array('controller' => 'downloads', 'action' => 'viewdown', $Report['Download']['id'],true), array('class' => 'glyphicon glyphicon-file','title' =>'Descargar documento', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
										</td>
									 <?php if($this->Session->read('role') =='Administrador'): ?>	

											<td>
												<?php echo $this->Html->link(__(''), array('action' => 'edit', $Report['Download']['id']),array('title'=>'Editar la información del documento','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
												<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $Report['Download']['id']), array('title'=>'Eliminar documento','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar el documento # %s', $Report['Download']['id'])); ?>
											</td>
										<?php endif; ?>
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

