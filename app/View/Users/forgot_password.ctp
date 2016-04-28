<div class="container">
	<div class="row">
		<div class="col-md-10">
		    <div class="page-header">
    		    <h2>¿Olvidaste tu Contraseña?</h2>
    		</div>
    		    <p>Si olvidaste tu contraseña por favor ingresa tu correo para resivir un correo electrónico de reactivación de contraseña.
    		        </p>
    		   
                    <div title = "En este campo por favor introduzca su correo electrónico"> <?php echo $this->Form->input('User', array('forgetpwd','label'=>'Email:','placeholder' => 'ejemplo@mail.com')); ?> </div>
                    <?php echo $this->Form->end(array('label'=>'Enviar', 'class'=>'btn btn-success')); ?>
        </div>
    </div>
</div>
