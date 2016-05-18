<div class="container">
    <?php echo $this->Form->create('User', array('forgetpwd')); ?>
	<div class="row">
		<div class="col-md-5">
		    <div class="page-header">
    		    <h2>¿Olvidó su contraseña?</h2>
    		    	
    		</div>
    		    <p>Ingrese su correo electrónico para reactivar su contraseña.</p>
        </div>
		<div class="col-md-12">
		    
        </div>
		<div class="col-md-4">
    		        
            <div title = "En este campo por favor introduzca su correo electrónico"> 
                <?php echo $this->Form->input('email', array('forgetpwd','class'=>'form-control','label'=>'Email:','placeholder' => 'ejemplo@mail.com')); ?> 
            </div>
            <br>
                <?php echo $this->Form->end(array('label'=>'Enviar', 'class'=>'btn btn-success')); ?>
            <br>
        </div>
    </div>
</div>