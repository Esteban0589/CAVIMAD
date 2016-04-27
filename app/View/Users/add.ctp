<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
			<fieldset>
				<div class="page-header">
					<h2><?php echo __('Nuevo Usuario'); ?></h2>
				</div>
				
				<?php 
				
				echo $this->Form->input('name', array('class'=>'form-control','label'=>'Nombre:','placeholder' => 'Nombre','error' => __('Este Campo no puede quedar vacio')));
				echo $this->Form->input('lastname1', array('class'=>'form-control','label'=>'Primer Apellido:','placeholder' => 'Primer Apellido'));
				echo $this->Form->input('lastname2', array('class'=>'form-control','label'=>'Segundo Apellido:','placeholder' => 'Segundo Apellido'));
				echo $this->Form->input('email', array('class'=>'form-control','label'=>'Email:','placeholder' => 'ejemplo@mail.com'));
				echo $this->Form->input('country', array('class'=>'form-control','label'=>'País:')); 
				echo $this->Form->input('state', array('class'=>'form-control','label'=>'Estado:'));
				echo $this->Form->input('city', array('class'=>'form-control','label'=>'Ciudad:')); 
				echo $this->Form->input('username', array('class'=>'form-control','label'=>'Nombre de Usuario:'));
				echo $this->Form->input('password', array('class'=>'form-control','label'=>'Contraseña:'));
				echo $this->Form->input('role', array('default' => 'Usuario','type'=>'hidden')); 
				echo $this->Form->input('activated', array('default' => '1','type'=>'hidden')); ?>
				<!--<?php// echo $this->Form->input('role', array('options'=>array('Usuario'=>'Usuario'), array('type'=>'hidden')));?>-->
				
				<?php echo $this->Form->input('image', array('type'=>'file','label'=>'Foto: ', 'id'=>'foto', 'class'=>'file', 'data-show-upload'=>'false','data-show-caption'=>'true', 'default'=>'icono.jpg'));
				echo $this->Form->input('image_dir',array('type'=>'hidden'));?>
				<br>
			</fieldset>
		<?php echo $this->Form->end(array('label'=>'Crear Usuario', 'class'=>'btn btn-success')); ?>
		<br>
		</div>
		
		<!--<div class="actions">-->
		<!--	<h3><?php echo __('Actions'); ?></h3>-->
		<!--	<ul>-->
		
		<!--		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>-->
		<!--		<li><?php echo $this->Html->link(__('List Administrators'), array('controller' => 'administrators', 'action' => 'index')); ?> </li>-->
		<!--		<li><?php echo $this->Html->link(__('New Administrator'), array('controller' => 'administrators', 'action' => 'add')); ?> </li>-->
		<!--	</ul>-->
		<!--</div>-->
	</div>
</div>

