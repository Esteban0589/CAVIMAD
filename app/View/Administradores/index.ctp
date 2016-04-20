<div class="administradores index">
	<h2><?php echo __('Administradores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('especialidad'); ?></th>
			<th><?php echo $this->Paginator->sort('curriculum'); ?></th>
			<th><?php echo $this->Paginator->sort('institucion'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($administradores as $administradore): ?>
	<tr>
		<td><?php echo h($administradore['Administradore']['id']); ?>&nbsp;</td>
		<td><?php echo h($administradore['Administradore']['especialidad']); ?>&nbsp;</td>
		<td><?php echo h($administradore['Administradore']['curriculum']); ?>&nbsp;</td>
		<td><?php echo h($administradore['Administradore']['institucion']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($administradore['Usuario']['nombreUsuario'], array('controller' => 'usuarios', 'action' => 'view', $administradore['Usuario']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $administradore['Administradore']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $administradore['Administradore']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $administradore['Administradore']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $administradore['Administradore']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Administradore'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Descargas'), array('controller' => 'descargas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Descarga'), array('controller' => 'descargas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Enlaces'), array('controller' => 'enlaces', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enlace'), array('controller' => 'enlaces', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sobrenosotros'), array('controller' => 'sobrenosotros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sobrenosotro'), array('controller' => 'sobrenosotros', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Publicaciones'), array('controller' => 'publicaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publicacione'), array('controller' => 'publicaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
