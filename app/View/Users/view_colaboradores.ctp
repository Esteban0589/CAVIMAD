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

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<h2 title= "Lista de los colaboradores de la página"><?php echo __('Lista de colaboradores'); ?></h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Nombre</th>
					                <th>Apellidos</th>
					                <th>Nombre de usuarios</th>
					                <th>Institución</th>
					                <th>Especialidad</th>
					                <th>Acciones</th>
					            </tr>
					        </thead>
					        <tbody>
					            <?php foreach ($colaboradores as $colaborador): ?>
											<?php if($colaborador['User']['role'] == 'Colaborador'){ ?>
												<tr>
													<td><?php echo h($colaborador['User']['name']); ?>&nbsp;</td>
													<td><?php echo h($colaborador['User']['lastname1']." ".$colaborador['User']['lastname2']); ?>&nbsp;</td>
													<td><?php echo h($colaborador['User']['username']); ?>&nbsp;</td>
													<td><?php echo h($colaborador['User']['institution']); ?>&nbsp;</td>
													<td><?php echo h($colaborador['Administrator']['specialty']); ?>&nbsp;</td>
													<td title= "Ir al perfil del colaborador" class="actions" style="text-align: right;">
														<?php echo $this->Html->link(__('Ir al perfil'), array('action' => 'view', $colaborador['User']['id'])); ?>
													</td>
												</tr>
												<?php }?>
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