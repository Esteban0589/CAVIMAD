<div class="usuarios index">
	<h2><?php echo __('Usuarios'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('apellido1'); ?></th>
			<th><?php echo $this->Paginator->sort('apellido2'); ?></th>
			<th><?php echo $this->Paginator->sort('correo'); ?></th>
			<th><?php echo $this->Paginator->sort('pais'); ?></th>
			<th><?php echo $this->Paginator->sort('estado'); ?></th>
			<th><?php echo $this->Paginator->sort('ciudad'); ?></th>
			<th><?php echo $this->Paginator->sort('nombreUsuario'); ?></th>
			<th><?php echo $this->Paginator->sort('contrasena'); ?></th>
			<th><?php echo $this->Paginator->sort('rol'); ?></th>
			<th><?php echo $this->Paginator->sort('foto'); ?></th>
			<th><?php echo $this->Paginator->sort('foto_dir'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usuarios as $usuario): ?>
	<tr>
		<td><?php echo h($usuario['Usuario']['id']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['apellido1']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['apellido2']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['correo']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['pais']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['estado']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['ciudad']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['nombreUsuario']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['contrasena']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['rol']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['foto']); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['foto_dir']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usuario['Usuario']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usuario['Usuario']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Usuario'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Administradores'), array('controller' => 'administradores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Administradore'), array('controller' => 'administradores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Familias'), array('controller' => 'familias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Familia'), array('controller' => 'familias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Generos'), array('controller' => 'generos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Genero'), array('controller' => 'generos', 'action' => 'add')); ?> </li>
	</ul>
</div>
