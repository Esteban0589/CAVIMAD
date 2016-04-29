<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php if($_SESSION['role']=='Administrador'): ?>	 
				<?php echo $this->Form->create('User', array('type'=>'file', 'novalidate'=>'novalidate')); ?>
		        
		        <fieldset>
		            <div class="page-header">
		            	
			            <h2><?php echo __('Editar Rol'); ?></h2>            
	            	</div>
	            	<?php echo $this->Form->input('id');?>
	          		<h4> <?php echo $this->request->data['User']['name'].' '.$this->request->data['User']['lastname1'].' '.$this->request->data['User']['lastname2']; ?></h4>
	            	<div>&nbsp</div>
	        	</fieldset>
	        	<?php echo $this->Form->input('role', array('class'=>'form-control','options'=>array('Administrador'=>'Administrador', 'Colaborador'=>'Colaborador', 'Editor'=>'Editor', 'Usuario'=>'Usuario'),'label'=>'Rol:'));?>
	        	<br>
	        	<?php echo $this->Form->end(array('label'=>'Editar', 'class'=>'btn btn-success')); ?>
	            <div>&nbsp</div>
	            <div>&nbsp</div>
            <?php endif; ?>
            
            <?php if($_SESSION['role']!='Administrador'): ?>
            	<div class="alert alert-warning alert-dismissable">
                	<p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           		</div>
           <?php endif; ?> 
           
              
        </div>
    </div>
</div>