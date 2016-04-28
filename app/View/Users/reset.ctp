<div class="container">
	<div class="row">
		<div class="col-md-10">
		    <div class="page-header">
    		    <h2>Restablecer contraseña</h2>
    		</div>
    		
                <?php echo $this->Form->create('User', array('reset')); ?>
                <?php echo $this->Form->input('password', array('label'=>'Nueva contraseña: ','placeholder' => 'Contraseña'));?>
                <?php echo $this->Form->input('password', array('label'=>'Repita su contraseña: ','placeholder' => 'Repita Contraseña'));;?><br>
                <?php echo $this->Form->end(array('label'=>'Restablecer', 'class'=>'btn btn-success')); ?>
        </div>
    </div>
</div>