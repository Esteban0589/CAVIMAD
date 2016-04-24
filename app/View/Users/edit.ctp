<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
	        <fieldset>
	            <div class="page-header">
		            <h2><?php echo __('Editar perfil'); ?></h2>
            	</div>

            	<?php echo $this->Form->input('id');?>
            	<?php echo $this->Form->input('name', array('class'=>'form-control','label'=>'Nombre:')); ?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('lastname1', array('class'=>'form-control','label'=>'Primer Apellido:'));?> 
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('lastname2', array('class'=>'form-control','label'=>'Segundo Apellido:'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('email', array('class'=>'form-control','label'=>'Email:'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('country', array('class'=>'form-control','label'=>'Pais:'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('state', array('class'=>'form-control','label'=>'Estado:'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('city', array('class'=>'form-control','label'=>'Ciudad:'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('image', array('type'=>'file','label'=>'Foto: ', 'id'=>'foto', 'class'=>'file', 'data-show-upload'=>'false','data-show-caption'=>'true', 'default'=>'icono.jpg'));?>
            	<?php echo $this->Form->input('image_dir',array('type'=>'hidden'));?>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('image_dir',array('type'=>'hidden'));?>
	
        	</fieldset>
        	<br>
        	<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>
            <div>&nbsp</div>
            <div>&nbsp</div>
        </div>
    </div>
</div>
	


