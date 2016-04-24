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
							<th><?php echo $this->Paginator->sort('Primer apellido'); ?></th>
							<th><?php echo $this->Paginator->sort('Segundo apellido'); ?></th>
							<th><?php echo $this->Paginator->sort('Nombre de usuario'); ?></th>
			
						</tr>
					</thead>
					
					<tbody>
					<?php foreach ($managers as $manager): ?>
						<tr>
							<td><?php echo h($manager['User']['name']); ?>&nbsp;</td>
							<td><?php echo h($manager['User']['lastname1']); ?>&nbsp;</td>
							<td><?php echo h($manager['User']['lastname2']); ?>&nbsp;</td>
							<td><?php echo h($manager['User']['username']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('Ir al perfil'), array('action' => 'view', $manager['User']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					
				</table>
					
			</div>
                            
		</div><!-- row end -->
					
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
					</div>
</div>
</div>
</div>