<div class="container">
	<div class="news view">
			<h2>
					<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-arrow-left','title' =>'Volver a lista de noticias', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
				<?php echo __('Noticia'); ?>
				<?php if($this->Session->read('Auth')['User']['role'] =='Administrador'): ?>
					<?php echo $this->Html->link(__(''), array('action' => 'edit', $news['News']['id']), array('class' => 'glyphicon glyphicon-pencil','title' =>'Editar esta noticia', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
					<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $news['News']['id']), array('class' => 'glyphicon glyphicon-trash', 'title' =>"Eliminar esta noticia",'style'=>'color: #860000;    font-size:25px;     padding: 5px;'), __('Está seguro de que desea eliminar # %s?', $news['News']['id'])); ?>
				<?php endif; ?>
					
			</h2>
		<div class="news form col-md-4">

			<dl>
				<dt><h5><?php echo __('Título'); ?></h5></dt>
				<dd>
					<?php echo h($news['News']['title']); ?>
					&nbsp;
				</dd>
				<dt><h5><?php echo __('Descripción'); ?></h5></dt>
				<dd>
					<?php echo h($news['News']['description']); ?>
					&nbsp;
			</dl>
		</div>
		<div class="news form col-md-8">
					<h5><?php echo __('Imagen'); ?></h5>
					<?php echo $this->Html->image('../files/home_picture/image/'.$news['News']['image_dir'] . '/thumb_' .$news['News']['image'], array('class' => 'img-thumbnail img-responsive'));  ?>
					<br>
		</div>
	</div>
	
</div>
