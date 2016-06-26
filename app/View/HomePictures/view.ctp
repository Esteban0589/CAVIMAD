<div class="container">
	<div class="homePictures view">
		<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
			<h2>
				<?php echo __('Imagen de portada'); ?>
				<?php echo $this->Html->link(__(''), array('action' => 'add'), array('class' => 'glyphicon glyphicon-upload','title' =>'Agregar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo $this->Html->link(__(''), array('action' => 'edit', $homePicture['HomePicture']['id']), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar imagen', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-th-large','title' =>'Ir a galeria', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $homePicture['HomePicture']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar imagen de portada",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $homePicture['HomePicture']['id'])); ?>
					
			</h2>
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
		<?php endif; ?>
		<?php if($this->Session->read('Auth')['User']['role'] !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?> 
	</div>
	
</div>
