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
		<?php if($this->Session->read('role')=='Administrador'): ?>
		<div class="col-md-12">
			<h2 title= "Lista de usuarios de la página"><?php echo __('Administrar Usuarios'); ?></h2>
			
			<div class="row small k-equal-height"><!-- row -->
                              
				 <div class="col-lg-12 col-md-6 col-sm-12">
									
					<table id="example" class="display" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th>Nombre</th>
					                <th>Apellidos</th>
					                <th>Email</th>
					                <th>País</th>
					                <th>Nombre de usuarios</th>
					                <th>Rol</th>
					                <th>Estado</th>
					                <th>Editar rol</th>
					                <th>Habilitar/Deshabilitar</th>
					                
					            </tr>
					        </thead>
					        <tbody>
					           	<?php foreach ($users as $user): ?>
									<tr>
										<td><?php echo $user['User']['name']; ?>&nbsp;</td>
										<td><?php echo $user['User']['lastname1'].' '.$user['User']['lastname2']; ?>&nbsp;</td>
										<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
										<td><?php echo $user['User']['country'].', '.$user['User']['state'].', '.$user['User']['city']; ?>&nbsp;</td>
										<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
										<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
										<td><?php if(($user['User']['activated'])==1){ 
														echo 'Activo';
													}else{
														if(($user['User']['activated'])==2){ 
														echo 'Deshabilitado';
														}else{
															echo 'Inactivo';
														} 
													}
										
											?>&nbsp;
										</td>
										<td class="actions" >
											<?php echo $this->Html->link(__('Editar rol'), array('action' => 'editrol', $user['User']['id'])); ?>
										</td>
										<td class="actions" >
											<?php if(($user['User']['activated'])==1){ 
														echo $this->Html->link(__('Deshabilitar'), array('action' => 'habdes', $user['User']['id']));
													}else{
														if(($user['User']['activated'])==2){ 
															echo $this->Html->link(__('Habilitar'), array('action' => 'habdes', $user['User']['id']));
														}else{
															echo 'Inactivo';
														} 
													}
										
											?>
										</td>
										<!--Esto lo comente porque tenemos que ver como vamos a manejar la deshabilitacion y habilitacion de usuarios-->
										<!--<td class="actions" align=center>-->
										<!--	<?php echo $this->Html->link(__('Activación'), array('action' => 'editactivated', $user['User']['id'])); ?>-->
										<!--</td>-->
									</tr>
								<?php endforeach; ?> 

					        </tbody>
					</table>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if($this->Session->read('role')!='Administrador'): ?>
            <div class="alert alert-warning alert-dismissable">
                <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           	</div>
   		<?php endif; ?>     
		
	</div>
	<style>
		.dataTables_filter label, .dataTables_filter input {
			float: right;
			line-height: 40px;
		}
	</style>
</div>

