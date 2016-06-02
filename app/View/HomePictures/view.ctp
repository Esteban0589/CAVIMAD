<div class="container">
	<div class="homePictures view">
	<h2><?php echo __('Imagen de portada'); ?></h2>
		<dl>
			<dt><h5><?php echo __('Título'); ?></h5></dt>
			<dd>
				<?php echo h($homePicture['HomePicture']['title']); ?>
				&nbsp;
			</dd>
			<dt><h5><?php echo __('Descripción'); ?></h5></dt>
			<dd>
				<?php echo h($homePicture['HomePicture']['description']); ?>
				&nbsp;
			</dd>
			<dt><h5><?php echo __('Imagen'); ?></h5></dt>
			<dd>
				<?php echo $this->Html->image('../files/home_picture/image/'.$homePicture['HomePicture']['image_dir'] . '/thumb_' .$homePicture['HomePicture']['image'], array('class' => 'img-thumbnail img-responsive'));  ?>
				&nbsp;
			</dd>

		</dl>
	</div>
	<div class="actions">
		<h3><?php echo __('Acciones'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Editar imagen'), array('action' => 'edit', $homePicture['HomePicture']['id']),array('title'=>'Editar detalles de la imagen actual')); ?> </li>
			<li><?php echo $this->Form->postLink(__('Eliminar imagen'), array('action' => 'delete', $homePicture['HomePicture']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $homePicture['HomePicture']['id']))); ?> </li>
			<li><?php echo $this->Html->link(__('Ver galeria'), array('action' => 'index'),array('title'=>'Ver todas las imagenes de portada')); ?> </li>
			<li><?php echo $this->Html->link(__('Agregar imagen'), array('action' => 'add'),array('title'=>'Agregar imagen de portada a galeria')); ?> </li>
		</ul>
	</div>
</div>
