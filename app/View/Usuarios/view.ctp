<div class="usuarios view">
<h2><?php echo __('Usuario'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellido1'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['apellido1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellido2'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['apellido2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Correo'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['correo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['pais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ciudad'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['ciudad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NombreUsuario'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['nombreUsuario']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contrasena'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['contrasena']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['rol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['foto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto Dir'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['foto_dir']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usuario'), array('action' => 'edit', $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usuario'), array('action' => 'delete', $usuario['Usuario']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usuario['Usuario']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Administradores'), array('controller' => 'administradores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Administradore'), array('controller' => 'administradores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Familias'), array('controller' => 'familias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Familia'), array('controller' => 'familias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Generos'), array('controller' => 'generos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Genero'), array('controller' => 'generos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Administradores'); ?></h3>
	<?php if (!empty($usuario['Administradore'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Especialidad'); ?></th>
		<th><?php echo __('Curriculum'); ?></th>
		<th><?php echo __('Institucion'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($usuario['Administradore'] as $administradore): ?>
		<tr>
			<td><?php echo $administradore['id']; ?></td>
			<td><?php echo $administradore['especialidad']; ?></td>
			<td><?php echo $administradore['curriculum']; ?></td>
			<td><?php echo $administradore['institucion']; ?></td>
			<td><?php echo $administradore['usuario_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'administradores', 'action' => 'view', $administradore['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'administradores', 'action' => 'edit', $administradore['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'administradores', 'action' => 'delete', $administradore['id']), array('confirm' => __('Are you sure you want to delete # %s?', $administradore['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Administradore'), array('controller' => 'administradores', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Familias'); ?></h3>
	<?php if (!empty($usuario['Familia'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Caracteristica'); ?></th>
		<th><?php echo __('Bibliografia'); ?></th>
		<th><?php echo __('Comentariosadicionale'); ?></th>
		<th><?php echo __('Autor'); ?></th>
		<th><?php echo __('Distribucionglobal'); ?></th>
		<th><?php echo __('Distribucionlocal'); ?></th>
		<th><?php echo __('Habitat'); ?></th>
		<th><?php echo __('Subordene Id'); ?></th>
		<th><?php echo __('Administradore Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($usuario['Familia'] as $familia): ?>
		<tr>
			<td><?php echo $familia['id']; ?></td>
			<td><?php echo $familia['nombre']; ?></td>
			<td><?php echo $familia['descripcion']; ?></td>
			<td><?php echo $familia['caracteristica']; ?></td>
			<td><?php echo $familia['bibliografia']; ?></td>
			<td><?php echo $familia['comentariosadicionale']; ?></td>
			<td><?php echo $familia['autor']; ?></td>
			<td><?php echo $familia['distribucionglobal']; ?></td>
			<td><?php echo $familia['distribucionlocal']; ?></td>
			<td><?php echo $familia['habitat']; ?></td>
			<td><?php echo $familia['subordene_id']; ?></td>
			<td><?php echo $familia['administradore_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'familias', 'action' => 'view', $familia['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'familias', 'action' => 'edit', $familia['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'familias', 'action' => 'delete', $familia['id']), array('confirm' => __('Are you sure you want to delete # %s?', $familia['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Familia'), array('controller' => 'familias', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Generos'); ?></h3>
	<?php if (!empty($usuario['Genero'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Caracteristicas'); ?></th>
		<th><?php echo __('Bibliografia'); ?></th>
		<th><?php echo __('Comentariosadicionales'); ?></th>
		<th><?php echo __('Autor'); ?></th>
		<th><?php echo __('Distribucionglobal'); ?></th>
		<th><?php echo __('Distribucionlocal'); ?></th>
		<th><?php echo __('Habitat'); ?></th>
		<th><?php echo __('Biologiayecologia'); ?></th>
		<th><?php echo __('Familia Id'); ?></th>
		<th><?php echo __('Administradore Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($usuario['Genero'] as $genero): ?>
		<tr>
			<td><?php echo $genero['id']; ?></td>
			<td><?php echo $genero['nombre']; ?></td>
			<td><?php echo $genero['descripcion']; ?></td>
			<td><?php echo $genero['caracteristicas']; ?></td>
			<td><?php echo $genero['bibliografia']; ?></td>
			<td><?php echo $genero['comentariosadicionales']; ?></td>
			<td><?php echo $genero['autor']; ?></td>
			<td><?php echo $genero['distribucionglobal']; ?></td>
			<td><?php echo $genero['distribucionlocal']; ?></td>
			<td><?php echo $genero['habitat']; ?></td>
			<td><?php echo $genero['biologiayecologia']; ?></td>
			<td><?php echo $genero['familia_id']; ?></td>
			<td><?php echo $genero['administradore_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'generos', 'action' => 'view', $genero['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'generos', 'action' => 'edit', $genero['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'generos', 'action' => 'delete', $genero['id']), array('confirm' => __('Are you sure you want to delete # %s?', $genero['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Genero'), array('controller' => 'generos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
