
<div id="k-body"><!-- content wrapper -->
    
	<div class="container"><!-- container -->
    
    	<?php if($_SESSION['role']=='Administrador'): ?>
    	
        <div class="row"><!-- row -->
            
			<div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
				<div class="categories form">
					<ul class="breadcrumb">
						    <li>
								<?php echo $this->Html->link(__('Manejar nivele taxonómico'), array('action'=>'index', 'alias'=>$alias));?>
								<span class="divider">/</span>
							</li>
						    <li class="active">
						    	<?php echo __('Editar nivel taxonómico'); ?>
						    </li>
						</ul>
					<?php echo $this->Form->create('Category', array('class'=>'form-horizontal','onsubmit' => "return confirm(\"Recuerde que la clasificación debe de tener congruencia con respecto a su padre\");"));?>
					<fieldset class="col-lg-4 col-md-4" >
								<h2><?php echo __('Editar taxón'); ?></h2>
							<?php
								echo $this->Form->input('id');
								echo $this->Form->input('parent_id', array('div'=>'control-group','title'=>'Escoja la categoría a la que pertenecera el taxón a agregar','placeholder'=>'','options'=>$parentCategories,'empty'=>__('Root'),
											'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('classification', array('div'=>'control-group','title'=>'Escoja el tipo de nivel taxonómico','placeholder'=>'','options'=>$classification,
										'before'=>'<label class="control-label">'.__('Clasificación').'</label><div class="controls">',
										'after'=>$this->Form->error('classification', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('name', array('div'=>'control-group','placeholder'=>'','title'=>'Ingrese el nombre del taxón',
											'before'=>'<label class="control-label">'.__('Nombre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('description', array('type'=>'textarea','rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese una breve descripción del nivel taxonómico ingresado. Campo de texto expandible',
										'before'=>'<label class="control-label">'.__('Descripción').'</label><div class="controls">',
										'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false));

								echo $this->Form->input('slug', array('type'=>'hidden','div'=>'control-group','placeholder'=>'', 'readonly'=>true,
											'before'=>'<label class="control-label">'.__('Slug').'</label><div class="controls">',
											'after'=>$this->Form->error('slug', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));
											
								echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'hidden','placeholder'=>'',
											'before'=>'<label class="control-label">'.__('Publicado').'</label><div class="controls">',
											'after'=>$this->Form->error('published', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>''));
							?>
							
								<?php if($this->request->data['Category']['classification']=='Familia'):?>
									
									<?php echo $this->Form->input('Family.0.id'); ?>
									<?php echo $this->Form->input('Family.0.author', array('required' => false,'label'=>'Autor','class' => 'form-control','title'=>'Ingrese el nombre del autor del nivel taxonómico'));?>
									
									<?php echo $this->Form->input('Family.0.characteristic', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las características de la familia. Campo de texto expandible','label'=>'Características'));?>

								
									<?php echo $this->Form->input('Family.0.bibliography', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las referencias bibliográficas de la familia. Campo de texto expandible','label'=>'Bibliografía'));?>

									<?php echo $this->Form->input('Family.0.habitat', array('required' => false,'label'=>'Hábitat','class' => 'form-control','title'=>'Ingrese el nombre del habitad del nivel taxonómico'));?>
								
									<?php echo $this->Form->input('Family.0.globaldistribution', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la distribución global del nivel taxonómico. Campo de texto expandible','label'=>'Distribucion global'));?>
				
									<?php echo $this->Form->input('Family.0.observation', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las observaciones del nivel taxonómico. Campo de texto expandible','label'=>'Observaciones'));?>
									
								<?php endif; ?>
								<?php if($this->request->data['Category']['classification']=='Genero'):?>
									
									<?php echo $this->Form->input('Gender.0.id'); ?>	
									<?php echo $this->Form->input('Gender.0.author', array('required' => false,'label'=>'Autor','class' => 'form-control','title'=>'Ingrese el nombre del autor del nivel taxonómico'));?>
									
									<?php echo $this->Form->input('Gender.0.characteristic', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las características de la familia. Campo de texto expandible','label'=>'Características'));?>

								
									<?php echo $this->Form->input('Gender.0.bibliography', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las referencias bibliográficas de la familia. Campo de texto expandible','label'=>'Bibliografía'));?>

									<?php echo $this->Form->input('Gender.0.habitat', array('required' => false,'label'=>'Hábitat','class' => 'form-control','title'=>'Ingrese el nombre del habitad del nivel taxonómico'));?>
								
									<?php echo $this->Form->input('Gender.0.globaldistribution', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la distribución global del nivel taxonómico. Campo de texto expandible','label'=>'Distribucion global'));?>
				
									<?php echo $this->Form->input('Gender.0.observation', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las observaciones del nivel taxonómico. Campo de texto expandible','label'=>'Observaciones'));?>
									
									<?php echo $this->Form->input('Gender.0.biologyandecology', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la información sobre biología y ecología del nivel taxonómico. Campo de texto expandible','label'=>'Biologia y ecologia'));?>
									
								<?php endif; ?>
								
								
						        <br>
						        <div class="form-actions">
						            <!--<?php echo $this->Form->submit(__('Guardar'), array('class'=>'btn btn-primary', 'div'=>false,'title'=>'Guardar los datos ingresados'));?>            -->
        							<?php echo $this->Form->end(array('label'=>'Guardar datos', 'class'=>'btn btn-primary')); ?>

						            
						            
						            <!--La siguiente linea fue comentada debido a que el reset solamente limpia el formulario y no tiene mucho uso-->
	
						            <!--<?php echo $this->Form->reset(__('Cancel'), array('class'=>'btn', 'div'=>false));?>        </div>-->
								<br>
								<br>
								</div>
							</fieldset>
						
					<?php echo $this->Form->end();?>
				</div> 
			</div> 
		</div>
		
		<?php endif; ?>
		<?php if($_SESSION['role']!='Administrador'): ?>
            	<div class="alert alert-warning alert-dismissable">
                	<p><strong>Upps!</strong> No puedes acceder a esta página.</p>
           		</div>
   		<?php endif; ?>     
	</div> 
</div>