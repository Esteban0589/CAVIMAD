<div class="container">
	<div class="row">
		<div class="col-md-6">

			<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
	        
	        <fieldset>
	            <div class="page-header">
	            	
		            <h2><?php echo __('Activar/Desactivar Usuario'); ?></h2>            
            	</div>
            	

            	<?php echo $this->Form->input('id');?>
          		<h4> <?php echo $this->request->data['User']['name'].' '.$this->request->data['User']['lastname1'].' '.$this->request->data['User']['lastname2']; ?></h4>
            	<div>&nbsp</div>
            	<?php echo $this->Form->input('activated', array('options'=>array('1'=>'Activar', '0'=>'Desactivar'),'label'=>'Activación:'));?>

        	</fieldset>
        	<br>
        	<br>
        	<br>
        	<?php echo $this->Form->end(array('label'=>'Guardar', 'class'=>'btn btn-success')); ?>
            <div>&nbsp</div>
            <div>&nbsp</div>
              
        </div>
    </div>
</div>