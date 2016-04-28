<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
	        
	        <fieldset>
	            <div class="page-header">
	            	
		            <h2><?php echo __('Editar perfil'); ?></h2>
				<?php if($current_user['username']==$this->request->data['User']['username']): ?>	            
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
	            	<div title = "En este campo puede editar su País"><?php echo $this->Form->input('country', array('class'=>'form-control','label'=>'Pais:','placeholder' => 'País'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Estado/Provincia"><?php echo $this->Form->input('state', array('class'=>'form-control','label'=>'Estado:','placeholder' => 'Estado/provincia'));?></div>
	            	<div>&nbsp</div>
	            	<div title = "En este campo puede editar su Ciudad"><?php echo $this->Form->input('city', array('class'=>'form-control','label'=>'Ciudad:','placeholder' => 'Ciudad'));?></div>
	            	<div>&nbsp</div>
					<?php echo $this->Form->input('image', array('type'=>'file','label'=>'Foto: ', 'id'=>'foto', 'class'=>'file', 'data-show-upload'=>'false','data-show-caption'=>'true', 'default'=>'icono.jpg'));?>
	            	<?php echo $this->Form->input('image_dir',array('type'=>'hidden'));?>
	            	
	            	<?php if(($current_user['role']=='Administrador')||($current_user['role']=='Administrador')): ?>
	            		<?php echo $this->Form->create('Administrator'); ?>
	            		
	            		<?php echo $this->Form->input('Administrator.0.id'); ?>
						<?php echo $this->Form->input('Administrator.0.specialty', array('class'=>'form-control','label'=>'Especialidad:')); ?>
						<div>&nbsp</div>
						<?php echo $this->Form->input('Administrator.0.curriculum', array('class'=>'form-control','label'=>'Curriculum:'));?>
						<div>&nbsp</div>
						<?php echo $this->Form->input('Administrator.0.institution', array('class'=>'form-control','label'=>'Institución:'));?>
						<div>&nbsp</div>
						<?php echo $this->Form->input('Administrator.0.publication', array('class'=>'form-control','label'=>'Publicaciones:'));?>
						<div>&nbsp</div>

					<?php endif; ?>
					
		        	<div>&nbsp</div>
		            <div>&nbsp</div>
		        	</fieldset>
		        	<br>
		        	<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>
		            <div>&nbsp</div>
		            <div>&nbsp</div>
             <?php endif; ?>
             
             <?php if($current_user['username']!=$this->request->data['User']['username']): ?>
            	<div class="alert alert-warning alert-dismissable">
                 <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           </div>
           <?php endif; ?>        
        </div>
    </div>
</div>
	

