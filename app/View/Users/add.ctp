<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
			<fieldset>
				<div class="page-header">
					<h2><?php echo __('Nuevo Usuario'); ?></h2>
				</div>
				
				<div title = "En este campo por favor introduzca su nombre"><?php echo $this->Form->input('name', array('class'=>'form-control','label'=>'Nombre:','placeholder' => 'Nombre',));?></div>
				<div title = "En este campo por favor introduzca su primer apellido"><?php echo $this->Form->input('lastname1', array('class'=>'form-control','label'=>'Primer Apellido:','placeholder' => 'Primer Apellido'));?></div>
				<div title = "En este campo por favor introduzca su segundo apellido"><?php echo $this->Form->input('lastname2', array('class'=>'form-control','label'=>'Segundo Apellido:','placeholder' => 'Segundo Apellido'));?></div>
				<div title = "En este campo por favor introduzca su correo electrónico"><?php echo $this->Form->input('email', array('class'=>'form-control','label'=>'Email:','placeholder' => 'ejemplo@mail.com'));?></div>
				<div title = "En este campo por favor introduzca su país"><?php echo $this->Form->input('country', array('class'=>'form-control','label'=>'País:', 'placeholder' => 'País'));?></div>
				<div title = "En este campo por favor introduzca su estado o provincia"><?php echo $this->Form->input('state', array('class'=>'form-control','label'=>'Estado:','placeholder' => 'Provincia/Estado'));?></div>
				<div title = "En este campo por favor introduzca su ciudad"><?php echo $this->Form->input('city', array('class'=>'form-control','label'=>'Ciudad:','placeholder' => 'Ciudad')); ?></div>
				<div title = "En este campo por favor seleccione su ocupación"><?php echo $this->Form->input('occupation', array('class'=>'form-control', 'options'=>array('Estudiante'=>'Estudiante', 'Docente'=>'Docente', 'Investigador'=>'Investigador', 'Consultor'=>'Consultor', 'Universitario'=>'Universitario', 'Otro'=>'Otro'),'label'=>'Ocupación:','placeholder' => 'Ocupación')); ?></div>
				<div title = "En este campo por favor introduzca la institución a la que pertenece"><?php echo $this->Form->input('institution', array('class'=>'form-control','label'=>'Institución:','placeholder' => 'Institución')); ?></div>
				<div title = "En este campo por favor introduzca su nombre de usuario"><?php echo $this->Form->input('username', array('class'=>'form-control','label'=>'Nombre de Usuario:','placeholder' => 'EjemploUusario123'));?></div>
				<div>&nbsp</div>
				<div title = "Introducir, por favor, una contraseña que cumpla las especificaciones"><?php echo $this->Form->input('password', array('class'=>'form-control','label'=>'Contraseña (debe tener al menos una minúscula, una mayúscula, un número y tener entre 6 y 16 caracteres):','placeholder' => 'Contraseña'));?></div>
				<div title = "Por favor, repita su nueva contraseña en este campo"><?php echo $this->Form->input('repeat_password', array('class'=>'form-control','label'=>'Repita su contraseña:','placeholder' => 'Repita su contraseña', 'type' => 'password'));?></div>
				<div>&nbsp</div>
				<div><?php echo $this->Form->input('role', array('default' => 'Usuario','type'=>'hidden')); ?></div>
				<div><?php echo $this->Form->input('activated', array('default' => '0','type'=>'hidden')); ?> </div>
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
		<?php
		$conditions = array(
	  	  'User.id' => $this->Session->read('User.id'),
	  	  'User.security_key' => $this->Session->read('User.key')
		);?>
		
		
		<!--<?php //if ($this->User->hasAny($conditions)){ ?>-->
    			<!--<div class="alert alert-warning alert-dismissable">-->
       <!--         	<p><strong>Upps!</strong> No puedes acceder a esta página.</p>-->
       <!--         	</div>-->
		<!--<?php //} ?> -->

	</div>
	
</div>

