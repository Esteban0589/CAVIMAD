<section id="form"><!--form-->
	<div class="container">
			<div class="col-md-4 col-md-offset-2" style="border-right: 1px solid #eaeaea;padding-right: 35px;">
				<div class="login-form"><!--login form-->
					<?php echo $this->Flash->render('auth'); ?>
					<?php echo $this->Form->create('User'); ?>
               		<fieldset>
               			<div style="text-align: center">
							<h2>Ingrese su usuario</h2>
								<div title = "En este campo por favor introduzca su nombre de usuario" >
								<?php echo $this->Form->input('username', array('label'=>' ','type'=>'text','placeholder' => 'Usuario'));?>
								</div>
							<h2>Ingrese su contraseña</h2>
								<div title = "En este campo por favor introduzca su contraseña."> 
								<?php echo $this->Form->input ('password', array('label'=>' ','placeholder' => 'Contraseña'));?>
								</div>
							
						<br>
						<div title = "Marcar para mantener su sesión iniciada." >  <?php echo $this->Form->checkbox('remember_me'); ?> No cerrar sesión </div>
						<div>&nbsp</div> 
						<div >
						<?php echo $this->Form->end(array('label'=>'Ingresar', 'class'=>'btn btn-success')); ?>
						</div>
       		    <div>&nbsp</div>
						<div >
       		   		<?php echo $this->Html->link(__('¿Olvidó su contraseña?'), array('action' => 'forgot_password'), array(
							'class' => 'btn btn-success',
							));?>
						</div>
						<br>
					</div>
						
				</fieldset>
			</div><!--/login form-->

				<!--/sign up form-->
			
		</div>
 		<div class="col-md-4" style="margin-left: 60px; margin-top: 50px;">
				<br>
				<br>
			<div style="text-align: center" >
				<h2>¿No estás registrado?</h2>
			<form action="#">
				<p>
							<?php echo $this->Html->link(__('Regístrate'), array('action' => 'add'), array(
								'class' => 'btn btn-success',
							)); ?>
						</div>
				</p>
			</form>
		</div>
	</div>
	

</section><!--/form-->
