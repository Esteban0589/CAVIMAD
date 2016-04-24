<div class="container">
	<div class="row">
		<div class="col-md-6">

			<div class="page-header">
				<h2>Usuario: <?php echo $user['User']['name'].' '.$user['User']['lastname1']; ?></h2>
			</div>
			<div class="row">

				<div class="col col-sm-5">

					Nombre: <?php echo h($user['User']['name']); ?>
					<br/>
					<br/>
					Primer Apellido: <?php echo h($user['User']['lastname1']); ?>
					<br/>
					<br/>
					Segundo Apellido: <?php echo h($user['User']['lastname2']); ?>
	  				<br/>
					<br/>
					Email: <?php echo h($user['User']['email']); ?>
					<br/>
					<br/>
					País: <?php echo h($user['User']['country']); ?>
					<br/>
					<br/>
					Estado: <?php echo h($user['User']['state']); ?>
					<br/>
					<br/>
					Ciudad: <?php echo h($user['User']['city']); ?>
					<br/>
					<br/>
					Nombre de Usuario:<?php echo h($user['User']['username']); ?>
					<br/>
					<br/>
					Rol: <?php echo h($user['User']['role']); ?>
					&nbsp;
					<br/>
					<br/>

					<!--<div class="actions">-->
<!--	<h3><?php echo __('Actions'); ?></h3>-->
<!--	<ul>-->
<!--		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>-->
<!--		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('List Administrators'), array('controller' => 'administrators', 'action' => 'index')); ?> </li>-->
<!--		<li><?php echo $this->Html->link(__('New Administrator'), array('controller' => 'administrators', 'action' => 'add')); ?> </li>-->
<!--	</ul>-->
<!--</div>-->

				</div>


				<div class="col col-sm-7">
					<?php echo $this->Html->image('../files/user/image/' .$user['User']['image_dir'] . '/' . 'vga_' .$user['User']['image'], array('class' => 'img-thumbnail img-responsive')); ?>
				</div>
			</div>

		</div>
	</div>
</div>
























