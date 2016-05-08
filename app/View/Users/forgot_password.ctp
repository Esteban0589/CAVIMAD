<div class="container">
    <?php echo $this->Form->create('User', array('forgetpwd')); ?>
	<div class="row">
		<div class="col-md-10">
		    <div class="page-header">
    		    <h2>¿Olvidaste tu Contraseña?</h2>
    		    	
    		</div>
    		    <p>Si olvidó tu contraseña por favor ingrese su correo electrónico para reactivarla.
    		        </p>
    		        
                    <div title = "En este campo por favor introduzca su correo electrónico"> <?php echo $this->Form->input('email', array('forgetpwd','label'=>'Email:','placeholder' => 'ejemplo@mail.com')); ?> </div>
                    <br>
                    <?php echo $this->Form->end(array('label'=>'Enviar', 'class'=>'btn btn-success')); ?>
                    <br>
        </div>
    </div>
</div>