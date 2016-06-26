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
			<h2 title= "Lista de enlaces">
				<?php echo __('Enlaces'); ?>
				<?php if($this->Session->read('role') =='Administrador'): ?>
					<?php echo $this->Html->link(__('Agregar enlace'), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar enlace', 'style'=>'color: #3891D4;    font-size:25px; padding: 5px;')); ?>
			  	<?php endif; ?>
			</h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Título</th>
					                <th>Enlace</th>
					                <th>Descripción</th>
					                <th>Comentario</th>
					                <?php if($this->Session->read('role') =='Administrador'): ?>
					                	<th>Acciones</th>
					                <?php endif; ?>
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
										<?php if($this->Session->read('role') =='Administrador'): ?>
											<td>
												<?php echo $this->Html->link(__(''), array('action' => 'edit', $link['Link']['id']),array('title'=>'Editar la información del enlace','class' => 'glyphicon glyphicon-pencil', 'style' => 'font-size:25px; padding: 5px;')); ?>
												<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $link['Link']['id']), array('title'=>'Eliminar enlace','class' => 'glyphicon glyphicon glyphicon-trash', 'style' => 'font-size:25px; padding: 5px;'), __('Atención se va a eliminar el enlace # %s', $link['Link']['id'])); ?>
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






