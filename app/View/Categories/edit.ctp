
 <div id="k-body"><!-- content wrapper -->
    
    	<div class="container"><!-- container -->
        
            <div class="row"><!-- row -->
                
				<div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
						<div class="categories form">
						<ul class="breadcrumb">
						    <li>
								<?php echo $this->Html->link(__('Manejar nivele taxónomico'), array('action'=>'index', 'alias'=>$alias));?>
								<span class="divider">/</span>
							</li>
						    <li class="active"><?php echo __('Editar nivel taxónomico'); ?></li>
						</ul>
						<?php echo $this->Form->create('Category', array('class'=>'form-horizontal'));?>
					<fieldset class="col-lg-4 col-md-4" >
								<h2><?php echo __('Editar nivel taxónomico'); ?></h2>
							<?php
								echo $this->Form->input('id');
								echo $this->Form->input('parent_id', array('div'=>'control-group','title'=>'Escoja la categoria a la que pertenecera el nivel a agregar','placeholder'=>'','options'=>$parentCategories,'empty'=>__('Root'),
											'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('classification', array('div'=>'control-group','title'=>'Escoja el tipo de nivel taxónomico','placeholder'=>'','options'=>$classification,
										'before'=>'<label class="control-label">'.__('Clasificación').'</label><div class="controls">',
										'after'=>$this->Form->error('classification', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('name', array('div'=>'control-group','placeholder'=>'','title'=>'Ingrese el nombre del nivel taxónomico',
											'before'=>'<label class="control-label">'.__('Nombre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));
								echo $this->Form->input('description', array('type'=>'textarea','rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese una breve descripción del nivel taxónomico ingresado. Campo de texto expandible',
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
						        <br>
						        <div class="form-actions">
						            <?php echo $this->Form->submit(__('Guardar'), array('class'=>'btn btn-primary', 'div'=>false,'title'=>'Guardar los datos ingresados'));?>            
						            
						            					            <!--La siguiente linea fue comentada debido a que el reset solamente limpia el formulario y no tiene mucho uso-->

						            <!--<?php echo $this->Form->reset(__('Cancel'), array('class'=>'btn', 'div'=>false));?>        </div>-->
								<br>
							</fieldset>
							
						<?php echo $this->Form->end();?>
						</div>
        </div> 
     </div>
    </div> 
 </div>