
 <div id="k-body"><!-- content wrapper -->
    
    	<div class="container"><!-- container -->
        
            <div class="row"><!-- row -->
                
				<div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
						<div class="categories form">
						<ul class="breadcrumb">
						    <li>
								<?php echo $this->Html->link(__('Admisnitrar'.' '.$humanizeAlias), array('action'=>'index', 'alias'=>$alias));?>
								<span class="divider">/</span>
							</li>
						    <li class="active"><?php echo __('Edititar').' '.$humanizeAlias; ?></li>
						</ul>
						<?php echo $this->Form->create('Categoria', array('class'=>'form-horizontal'));?>
							<fieldset>
								<legend><?php echo __('Editar').' '.$humanizeAlias; ?></legend>
							<?php
								echo $this->Form->input('id');
								echo $this->Form->input('parent_id', array('div'=>'control-group','placeholder'=>'','options'=>$parentCategories,'empty'=>__('Root'),
											'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'input-xlarge'));                
								echo $this->Form->input('name', array('div'=>'control-group','placeholder'=>'',
											'before'=>'<label class="control-label">'.__('Nombre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'input-xlarge'));
								echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'checkbox','placeholder'=>'',
											'before'=>'<label class="control-label">'.__('Visible').'</label><div class="controls">',
											'after'=>$this->Form->error('published', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>''));
											
								echo $this->Form->input('slug', array('div'=>'control-group','placeholder'=>'', 'readonly'=>true,
											array('type' => 'hidden'),
											'before'=>'<label class="control-label">'.__('').'</label><div class="controls">',
											'after'=>$this->Form->error('slug', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'input-xlarge'));
							
							?>
						        <div class="form-actions">
						            <?php echo $this->Form->submit(__('Aceptar'), array('class'=>'btn btn-primary', 'div'=>false));?>          
						            <?php echo $this->Form->reset(__('Cancelar'), array('class'=>'btn', 'div'=>false));?>        </div>
							</fieldset>
						<?php echo $this->Form->end();?>
						</div>
        </div> 
     </div>
    </div> 
 </div>