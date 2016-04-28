<div class="container">
    <?php echo $this->Form->create('User', array('forgetpwd')); ?>
	<div class="row">
		<div class="col-md-10">
		    <div class="page-header">
    		    <h2>¿Olvidaste tu Contraseña?</h2>
    		    	
    		</div>
    		    <p>Si olvidaste tu contraseña por favor ingresa tu correo electrónico para reactivarla.
    		        </p>
    		        
                    <div title = "En este campo por favor introduzca su correo electrónico"> <?php echo $this->Form->input('email', array('forgetpwd','label'=>'Email:','placeholder' => 'ejemplo@mail.com')); ?> </div>
                    <?php echo $this->Form->end(array('label'=>'Enviar', 'class'=>'btn btn-success')); ?>
        </div>
    </div>
</div>