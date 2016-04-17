<div class="usuarios form">
<?php echo $this->Form->create('Usuario'); ?>
	<fieldset>
		<legend><?php echo __('Add Usuario'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido1');
		echo $this->Form->input('apellido2');
		echo $this->Form->input('correo');
		echo $this->Form->input('pais');
		echo $this->Form->input('estado');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('nombreUsuario');
		echo $this->Form->input('contrasena');
		echo $this->Form->input('rol');
		echo $this->Form->input('foto');
		echo $this->Form->input('foto_dir');
		echo $this->Form->input('Familia');
		echo $this->Form->input('Genero');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usuarios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Administradores'), array('controller' => 'administradores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Administradore'), array('controller' => 'administradores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Familias'), array('controller' => 'familias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Familia'), array('controller' => 'familias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Generos'), array('controller' => 'generos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Genero'), array('controller' => 'generos', 'action' => 'add')); ?> </li>
	</ul>
</div>
