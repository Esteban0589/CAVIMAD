<div class="container">
	<div class="row">
		<div class="col-md-6">

			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
	        
	        <fieldset>
	            <div class="page-header">
	            	
		            <h2><?php echo __('Editar Rol'); ?></h2>            
            	</div>
            	

            	<?php echo $this->Form->input('id');?>
          		<h4> <?php echo $this->request->data['User']['name'].' '.$this->request->data['User']['lastname1'].' '.$this->request->data['User']['lastname2']; ?></h4>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('role', array('options'=>array('admin'=>'Administrador', 'colaborador'=>'Colaborador', 'editor'=>'Editor', 'usuario'=>'Usuario'),'label'=>'Rol:'));?>

        	</fieldset>
        	<br>
        	<br>
        	<br>
        	<br>
        	<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>
            <div>&nbsp</div>
            <div>&nbsp</div>
              
        </div>
    </div>
</div>
	

	