<section id="form"><!--form-->
	<div class="container">
		<div class="row" align="center">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12col-lg-offset-3 col-md-offset-3 col-sm-offset-3 text-center">
				<div class="login-form"><!--login form-->
					<?php echo $this->Flash->render('auth'); ?>
					<?php echo $this->Form->create('User'); ?>
               		<fieldset>
						<div class="page-header" >
							<h2>Ingresa tu usuario</h2>
							</div>
								<div title = "En este campo por favor introduzca su nombre de usario">
								<?php echo $this->Form->input('username', array('label'=>' ','type'=>'text','placeholder' => 'Usuario'));?></div>
							
						
						<div class="page-header">
							<h2>Ingresa tu contraseña</h2>
							</div>
								<div title = "En este campo por favor introduzca su contraseña"> 
								<?php echo $this->Form->input ('password', array('label'=>' ','placeholder' => 'Contraseña'));?></div>
							
						
						<div title = "Marcar para recordar su sesion">  <?php echo $this->Form->checkbox('remember_me'); ?> Recordarme </div>
						<div>&nbsp</div> 
						<?php echo $this->Form->end(array('label'=>'Ingresar', 'class'=>'btn btn-success')); ?>
				
       		    <div>&nbsp</div>
       		   		<?php echo $this->Html->link(__('¿Olvidaste tu contraseña?'), array('action' => 'forgot_password'), array(
							'class' => 'btn btn-success',
							));?>
				</fieldset>
			</div><!--/login form-->

				<div class="page-header"><!--sign up form-->
					<h2>¿No estás registrado?</h2>
					</div>
					<form action="#">
						<p>
							<?php echo $this->Html->link(__('Registrate'), array('action' => 'add'), array(
								'class' => 'btn btn-success',
							)); ?>
						</p>
					</form>
				<!--/sign up form-->
			
		</div>
	</div>

</section><!--/form-->