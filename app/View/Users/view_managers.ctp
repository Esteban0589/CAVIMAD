<div class="container">
	<div class="row">
		<div class="col-md-10">

	<h2><?php echo __('Lista de Colaboradores'); ?></h2>
			
		<div class="row small k-equal-height"><!-- row -->
                              
			 <div class="col-lg-12 col-md-6 col-sm-12">
					
				<table class="table table-hover">
					
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('Nombre'); ?></th>
							<th><?php echo $this->Paginator->sort('Apellidos'); ?></th>
							<th><?php echo $this->Paginator->sort('Nombre de usuario'); ?></th>
							<th><?php echo $this->Paginator->sort('Institución'); ?></th>
							<th><?php echo $this->Paginator->sort('Especialidad'); ?></th>
						</tr>
					</thead>
					
					<tbody>
					<?php foreach ($colaboradores as $colaborador): ?>
						<tr>
							<td><?php echo h($colaborador['User']['name']); ?>&nbsp;</td>
							<td><?php echo h($colaborador['User']['lastname1']." ".$colaborador['User']['lastname2']); ?>&nbsp;</td>
							<td><?php echo h($colaborador['User']['username']); ?>&nbsp;</td>
							<td><?php echo h($colaborador['Administrator']['institution']); ?>&nbsp;</td>
							<td><?php echo h($colaborador['Administrator']['specialty']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('Ir al perfil'), array('action' => 'view', $colaborador['User']['id'])); ?>
							</td>
						</tr>
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