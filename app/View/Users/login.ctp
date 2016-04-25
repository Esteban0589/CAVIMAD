<section id="form"><!--form-->
	<div class="container">
		<div class="row" align="center">
			<div class="col-lg-4 col-md-4">
				<div class="login-form"><!--login form-->
					<?php echo $this->Flash->render('auth'); ?>
					<?php echo $this->Form->create('User'); ?>
               		<fieldset>
						<div class="title-median" >
							<h2>Ingresa tu usuario</h2>
							<h6>
								<?php 
								echo $this->Form->input('username', array('label'=>' ','type'=>'text','placeholder' => 'ejemplo@ejemplo.com'));?>
							</h6>
						</div>
						<div class="title-median">
							<h2>Ingresa tu contraseña</h2>
							<h6>
								<?php echo $this->Form->input ('password', array('label'=>' ','placeholder' => 'Contraseña'));?>
							</h6>
						</div>
						<div>&nbsp</div>   
					<?php 
						echo $this->Form->button(__('Ingresar'), array(
							'class' => 'btn-default btn-md cb-red',
							'div' => false,
							));
							echo $this->Form->end();
       		     	?>
       		    <div>&nbsp</div>
       		   		<?php 
						echo $this->Html->link(__('¿Olvidaste tu contraseña?'), array('action' => 'forgot_password'), array(
							'class' => 'btn-default btn-md cb-red',
							));?>
				</fieldset>
			</div><!--/login form-->
			</div>
			<div class="col-lg-4 col-md-4">
				<h2>O</h2>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="signup-form text-info"><!--sign up form-->
					<h2>¿No estás registrado?</h2>
					<form action="#">
						<p>
							<?php echo $this->Html->link(__('Registrate'), array('action' => 'add'), array(
								'class' => 'btn-default btn-md cb-red',
								'role' => 'button'
							)); ?>
						</p>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>

</section><!--/form-->