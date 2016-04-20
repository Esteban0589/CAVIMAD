<div class="administradores view">
<h2><?php echo __('Administradore'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($administradore['Administradore']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Especialidad'); ?></dt>
		<dd>
			<?php echo h($administradore['Administradore']['especialidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Curriculum'); ?></dt>
		<dd>
			<?php echo h($administradore['Administradore']['curriculum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institucion'); ?></dt>
		<dd>
			<?php echo h($administradore['Administradore']['institucion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($administradore['Usuario']['nombreUsuario'], array('controller' => 'usuarios', 'action' => 'view', $administradore['Usuario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Administradore'), array('action' => 'edit', $administradore['Administradore']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Administradore'), array('action' => 'delete', $administradore['Administradore']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $administradore['Administradore']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Administradores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Administradore'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Descargas'); ?></h3>
	<?php if (!empty($administradore['Descarga'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Clasificacion'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Abstract'); ?></th>
		<th><?php echo __('Paginarelacionada'); ?></th>
		<th><?php echo __('Administradore Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($administradore['Descarga'] as $descarga): ?>
		<tr>
			<td><?php echo $descarga['id']; ?></td>
			<td><?php echo $descarga['clasificacion']; ?></td>
			<td><?php echo $descarga['descripcion']; ?></td>
			<td><?php echo $descarga['abstract']; ?></td>
			<td><?php echo $descarga['paginarelacionada']; ?></td>
			<td><?php echo $descarga['administradore_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'descargas', 'action' => 'view', $descarga['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'descargas', 'action' => 'edit', $descarga['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'descargas', 'action' => 'delete', $descarga['id']), array('confirm' => __('Are you sure you want to delete # %s?', $descarga['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Descarga'), array('controller' => 'descargas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Enlaces'); ?></h3>
	<?php if (!empty($administradore['Enlace'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Clasificacion'); ?></th>
		<th><?php echo __('PaginaRelacionada'); ?></th>
		<th><?php echo __('Administradore Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($administradore['Enlace'] as $enlace): ?>
		<tr>
			<td><?php echo $enlace['id']; ?></td>
			<td><?php echo $enlace['link']; ?></td>
			<td><?php echo $enlace['descripcion']; ?></td>
			<td><?php echo $enlace['clasificacion']; ?></td>
			<td><?php echo $enlace['paginaRelacionada']; ?></td>
			<td><?php echo $enlace['administradore_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'enlaces', 'action' => 'view', $enlace['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'enlaces', 'action' => 'edit', $enlace['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'enlaces', 'action' => 'delete', $enlace['id']), array('confirm' => __('Are you sure you want to delete # %s?', $enlace['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Enlace'), array('controller' => 'enlaces', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sobrenosotros'); ?></h3>
	<?php if (!empty($administradore['Sobrenosotro'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mision'); ?></th>
		<th><?php echo __('Vision'); ?></th>
		<th><?php echo __('Objetivo'); ?></th>
		<th><?php echo __('Historia'); ?></th>
		<th><?php echo __('Administradore Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($administradore['Sobrenosotro'] as $sobrenosotro): ?>
		<tr>
			<td><?php echo $sobrenosotro['id']; ?></td>
			<td><?php echo $sobrenosotro['mision']; ?></td>
			<td><?php echo $sobrenosotro['vision']; ?></td>
			<td><?php echo $sobrenosotro['objetivo']; ?></td>
			<td><?php echo $sobrenosotro['historia']; ?></td>
			<td><?php echo $sobrenosotro['administradore_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sobrenosotros', 'action' => 'view', $sobrenosotro['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sobrenosotros', 'action' => 'edit', $sobrenosotro['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sobrenosotros', 'action' => 'delete', $sobrenosotro['id']), array('confirm' => __('Are you sure you want to delete # %s?', $sobrenosotro['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sobrenosotro'), array('controller' => 'sobrenosotros', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Publicaciones'); ?></h3>
	<?php if (!empty($administradore['Publicacione'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($administradore['Publicacione'] as $publicacione): ?>
		<tr>
			<td><?php echo $publicacione['id']; ?></td>
			<td><?php echo $publicacione['link']; ?></td>
			<td><?php echo $publicacione['descripcion']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'publicaciones', 'action' => 'view', $publicacione['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'publicaciones', 'action' => 'edit', $publicacione['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'publicaciones', 'action' => 'delete', $publicacione['id']), array('confirm' => __('Are you sure you want to delete # %s?', $publicacione['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Publicacione'), array('controller' => 'publicaciones', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
