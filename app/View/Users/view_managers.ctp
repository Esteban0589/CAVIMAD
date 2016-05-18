<div class="container">
	<div class="row">
		<div class="col-md-12">

	<h2 title= "Lista de los colaboradores de la página"><?php echo __('Lista de Colaboradores'); ?></h2>
			
		<div class="row small k-equal-height"><!-- row -->
                              
			 <div class="col-lg-12 col-md-6 col-sm-12">
					
				<table class="table table-hover">
					
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
							<th><?php echo $this->Paginator->sort('Apellidos'); ?></th>
							<th><?php echo $this->Paginator->sort('Nombre de usuario'); ?></th>
							<th title= "Institución a la que pertenece el colaborador"><?php echo $this->Paginator->sort('Institución'); ?></th>
							<th title= "Especialidad del colaborador"><?php echo $this->Paginator->sort('Especialidad'); ?></th>
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
                            
		<!--</div>
					
			<p>
			<?php
				echo $this->Paginator->counter(array(
					'format' => __('Página {:page} de {:pages}, mostrando {:current} resultados de {:count}')
					));
					?>	</p>
					<div class="paging">
					<?php
						echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
						echo $this->Paginator->numbers(array('separator' => ''));
						echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
					?>
					</div>-->
</div>
</div>
</div>