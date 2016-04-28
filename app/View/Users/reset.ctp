<div class="forgetpwd form" style="margin:5px auto 5px auto;width:450px;">
<?php echo $this->Form->create('User', array('reset')); ?>
<?php echo $this->Form->input('password', array('label'=>'Nueva contraseña: ','placeholder' => 'Contraseña'));?>
<?php echo $this->Form->input('password', array('label'=>'Repita su contraseña: ','placeholder' => 'Contraseña'));;?><br>
<input type="submit" class="button" style="float:left;margin-left:3px;" value="Aceptar" />
<?php echo $this->Form->end();?>
</div>