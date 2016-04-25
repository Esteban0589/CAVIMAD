<div class="users index">
	<h2><?php echo __('Lista de Colaboradores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
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
