<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
	        
	        <fieldset>
	            <div class="page-header">
	            	
		            <h2><?php echo __('Editar perfil'); ?></h2>
				<?php if($this->Session->read('Auth')['User']['username']==$this->request->data['User']['username']): ?>
				
	            	</div>
	            	
	
	            	<?php echo $this->Form->input('id');?>
	            	<div title = "En este campo puede editar su Nombre"><?php echo $this->Form->input('name', array('class'=>'form-control','label'=>'Nombre:','placeholder' => 'Nombre')); ?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Primer Apellido"><?php echo $this->Form->input('lastname1', array('class'=>'form-control','label'=>'Primer Apellido:','placeholder' => 'Primer Apellido'));?> </div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Segundo Apellido"><?php echo $this->Form->input('lastname2', array('class'=>'form-control','label'=>'Segundo Apellido:','placeholder' => 'Segundo Apellido'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Correo electrónico"><?php echo $this->Form->input('email', array('class'=>'form-control','label'=>'Email:','placeholder' => 'Correo electrónico'));?></div>
	            	<div>&nbsp</div>
	            	<small><div class="col-lg-16 col-sm-32"><p aling ="left"><i><a data-toggle="modal" data-target="#ModalPassword">Cambiar mi contraseña</a></i></p></div></small>
	            	<div title = "En este campo puede editar su País"><?php echo $this->Form->input('country', array('class'=>'form-control','label'=>'Pais:','placeholder' => 'País'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Estado/Provincia"><?php echo $this->Form->input('state', array('class'=>'form-control','label'=>'Estado:','placeholder' => 'Estado/provincia'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Ciudad"><?php echo $this->Form->input('city', array('class'=>'form-control','label'=>'Ciudad:','placeholder' => 'Ciudad'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo por favor seleccione su ocupación"><?php echo $this->Form->input('occupation', array('class'=>'form-control', 'options'=>array('Estudiante'=>'Estudiante', 'Docente'=>'Docente', 'Investigador'=>'Investigador', 'Consultor'=>'Consultor', 'Universitario'=>'Universitario', 'Otro'=>'Otro'),'label'=>'Ocupación:','placeholder' => 'Ocupación')); ?></div>
					<div>&nbsp</div>
					<div title = "En este campo por favor introduzca la institución a la que pertenece"><?php echo $this->Form->input('institution', array('class'=>'form-control','label'=>'Institución:','placeholder' => 'Institución')); ?></div>
					<div>&nbsp</div>
	            
	            	<!--<div title = "En este campo puede editar su Contraseña"><?php echo $this->Form->input('password', array('class'=>'form-control','label'=>'Contraseña:','placeholder' => 'Contraseña'));?></div>-->
	            	<!--<div>&nbsp</div>-->
					<?php echo $this->Form->input('image', array('type'=>'file','label'=>'Foto: ', 'id'=>'foto', 'class'=>'file', 'data-show-upload'=>'false','data-show-caption'=>'true', 'default'=>'icono.jpg'));?>
	                <?php echo $this->Form->input('image_dir',array('type'=>'hidden'));?>
	            	
	            	<?php if(($current_user['role']=='Administrador')||($current_user['role']=='Colaborador')): ?>

	            		<?php echo $this->Form->input('Administrator.0.id'); ?>
						<?php echo $this->Form->input('Administrator.0.specialty', array('class'=>'form-control','label'=>'Especialidad:')); ?>
						<div>&nbsp</div>
						<?php echo $this->Form->input('Administrator.0.publication', array('type'=>'textarea','class'=>'expanding','rows' => '5', 'cols' => '5','class'=>'form-control','label'=>'Publicaciones:'));?>
						<div>&nbsp</div>
						<?php echo $this->Form->input('Administrator.0.curriculum', array('type'=>'textarea','rows' => '5', 'cols' => '5','class'=>'form-control','label'=>'Curriculum:'));?>
						<div>&nbsp</div>

					<?php endif; ?>
					
	
		        	</fieldset>
		        	<br>
		        	<?php echo $this->Form->end(array('label'=>'Guardar', 'class'=>'btn btn-success')); ?>
		            <div>&nbsp</div>
		            <div>&nbsp</div>
             <?php endif; ?>
             <?php if($this->Session->read('Auth')['User']['username']!=$this->request->data['User']['username']): ?>
            	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           		</div>
           	<?php endif; ?>        
        </div>
    </div>
</div>
	

<!-- Modal que maneja el cambio de contraseña -->
<div id="ModalPassword" class="modal fade" role="dialog">
  <div class="modal-dialog">
<div class="col-md-6">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>Cambio de contraseña</h4>
      </div>
      <div class="modal-body">
      		<?php echo $this->Form->create( array('url' => 'new_password')); ?>
        	<div title = "En este campo debe de digitar su contraseña actual"><?php echo $this->Form->input('actual_password', array('class'=>'form-control','label'=>'Contraseña actual:','placeholder' => 'Contraseña actual','type' => 'password'));?></div>
        	<div title = "Digite aquí su nueva contraseña"><?php echo $this->Form->input('new_password', array('class'=>'form-control','label'=>'Nueva contraseña:','placeholder' => 'Nueva contraseña','type' => 'password'));?></div>
        	<div title = "Por favor, repita su nueva contraseña en este campo"><?php echo $this->Form->input('repeat_password', array('class'=>'form-control','label'=>'Repita su contraseña:','placeholder' => 'Repita su contraseña', 'type' => 'password'));?></div>
      		
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Guardar cambios</button>-->
        <?php echo $this->Form->end(array('label'=>'Guardar', 'controller'=>'User','action'=>'new_password', 'class'=>'btn btn-success')); ?>
      </div>
    </div>

  </div>
</div>