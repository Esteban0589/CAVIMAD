	<div id="k-body"><!-- content wrapper -->
	<div class="container">
	<div class="row">
		<?php if($this->Session->read('role') =='Administrador'): ?>

		<div class="news form col-md-6">
			<?php echo $this->Form->create('News', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
				<fieldset>
					<br>
					<h1>
						<?php echo __('Agregar Noticia'); ?>
						<?php echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'glyphicon glyphicon-th-large','title' =>'Ir a seccion de noticias', 'style'=>'color: #3891D4;    font-size:25px;     padding: 5px;')); ?>
						
					</h1>
				<?php
					echo $this->Form->input('title',array('class'=>'form-control','label'=>'Título','title'=>'Ingrese el titulo de la noticia'));
					echo $this->Form->input('description',array('class'=>'form-control','label'=>'Descripcíon','rows' => '5', 'cols' => '5','title'=>'Ingrese una descripcion de la noticia' ));
					echo $this->Form->input('position',array('class'=>'form-control','label'=>'Posicion de imagen ','title'=>'Seleccione la posicion de la noticia','options'=>$position));
					
					echo $this->Form->input('NewsEventsPicture.0.image', array('class'=>'form-control','type'=>'file','label'=>'Imagen','title'=>'Seleccione la imagen a cargar' ));
					echo "Agregue más imagenes desde la edicion de noticia. ";
					echo "<br>";
					echo $this->Form->input('NewsEventsPicture.0.image_dir', array('type'=>'hidden'));
					echo $this->Form->input('NewsEventsPicture.0.news_id', array('type'=>'hidden'));
					$qwe = $_SESSION['Auth']['User']['id'];
					echo $this->Form->input('NewsEventsPicture.0.user_id', array('type'=>'hidden', 'default'=>$qwe));

					//  $qwe=$this->Session->read('Auth');
					// debug($qwe);
					// echo $this->Form->input('User.0.users_id', array('type'=>'hidden'));
					
					
				?>
				<br>
				</fieldset>
			<?php echo $this->Form->end(array('label'=>'Guardar noticia', 'class'=>'btn btn-success','title'=>'Guardar noticia')); ?>
		</div>
		<?php endif; ?>
			<?php if($this->Session->read('role') !='Administrador'): ?>
        	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
       <?php endif; ?>  
	</div>
	<br>
</div>
</div>