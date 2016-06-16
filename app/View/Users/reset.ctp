<div class="container">
	<div class="row">
		<div class="col-md-4">
		    <div class="page-header">
    		    <h2>Restablecer contraseña</h2>
    		</div>
    		
                <?php echo $this->Form->create('User', array('novalidate'=>'novalidate')); ?>
                <div title = "Digite aquí su nueva contraseña"><?php echo $this->Form->input('password', array('class'=>'form-control','label'=>'Nueva contraseña:','placeholder' => 'Nueva contraseña'));?></div>
        	    <div title = "Por favor, repita su nueva contraseña en este campo"><?php echo $this->Form->input('repeat_password', array('class'=>'form-control','label'=>'Repita su contraseña:','placeholder' => 'Repita su contraseña', 'type' => 'password'));?></div>
                <br>
                <?php echo $this->Form->end(array('label'=>'Restablecer', 'class'=>'btn btn-success')); ?>
                <br>
        </div>
    </div>
</div>