<div class="administradores form">
<?php echo $this->Form->create('Administradore'); ?>
	<fieldset>
		<legend><?php echo __('Add Administradore'); ?></legend>
	<?php
		echo $this->Form->input('especialidad');
		echo $this->Form->input('curriculum');
		echo $this->Form->input('institucion');
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('Publicacione');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Administradores'), array('action' => 'index')); ?></li>
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
