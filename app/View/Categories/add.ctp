<script>
   //Este script se utiliza para esconder o mostrar secciones de dropdown según lo seleccionado.
   $(document).ready(function() {
   			$("#drop1").change(function() {
   
   						// $('#log').text("");
   							$(".box").hide();
   								var e = document.getElementById("hide");
      							 e.style.display = 'block';
   						
   						if ($("#drop1 :selected").text() == 'Familia' ) {
   							
   
   							$(".box").hide();
                      			$(".familia").show();
                      			$(".submit").show();
                      			
   						}
   						if ($("#drop1 :selected").text() == 'Genero' ) {
   							$(".box").hide();
                      			$(".genero").show();
                      			$(".submit").show();
   						}

   						
   						
     				}
     				);
   
   });
   
</script>
<script type="text/javascript">
   function toggle_visibility_off() {
      var e = document.getElementById("hide");
      e.style.display = 'none';
   }
   
</script>




<body onload="toggle_visibility_off()">

	<div id="k-body"><!-- content wrapper -->
		
		<div class="container"><!-- container -->
		
			<?php if($_SESSION['role']=='Administrador'): ?> 
			
		    <div class="row"><!-- row -->
		        
				<div class="col-lg-12 col-md-12"><!-- doc body wrapper -->
					<!--<div class="categories form">-->
							
						<ul class="breadcrumb">
						    <li>
						    	<!--Ruta del arbol-->
								<?php echo $this->Html->link(__('Manejar niveles taxonómicos'), array('action'=>'index', 'alias'=>$alias));?>
								<span class="divider">/</span>
							</li>
						    <li class="active"><?php echo __('Agregar taxón'); ?></li>
						</ul>
						<!--'novalidate'=>'novalidate'-->
						<?php echo $this->Form->create('Category', array('class'=>'form-horizontal','onsubmit' => "return confirm(\"Recuerde que la clasificación debe de tener congruencia con respecto a su padre\");", 'enctype'=>'multipart/form-data'));?>
						<div class="col-lg-4 col-md-4" >
							<fieldset>
							
							<!--Titulo principal-->
							<h2><?php echo __('Agregar nivel taxonómico'); ?></h2>
							<!--Nombre-->
							<div title="Seleccione el taxón padre">
							<?php echo $this->Form->input('parent_id', array('div'=>'control-group','placeholder'=>'','options'=>$parentCategories,
											'empty'=>array('0'=>__('Root')),
											'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">',
											'after'=>$this->Form->error('parent_id', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
											'label'=>false, 'class'=>'form-control'));?></div>
							<!--Clasificacion-->
							<div title="Seleccione la clasificación del nuevo taxón">	
		
							<?php echo $this->Form->input('classification', array('div'=>'control-group','id'=>'drop1','placeholder'=>'','options'=>$classification,
											'before'=>'<label class="control-label">'.__('Clasificación').'</label><div class="controls">',
											'after'=>$this->Form->error('classification', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));?></div>
											
							<?php echo $this->Form->input('name', array('div'=>'control-group','placeholder'=>'','title'=>'Ingrese el nombre del nivel taxonómico',
											'before'=>'<label class="control-label">'.__('Nombre').'</label><div class="controls">',
											'after'=>$this->Form->error('name', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));?>
							<div title="Introduzca el slug del nuevo taxón">		
							<!--Slug que esta hidden-->
							<?php echo $this->Form->input('slug', array('type'=>'hidden','div'=>'control-group','placeholder'=>'', 'readonly'=>true,
											'before'=>'<label class="control-label">'.__('Slug').'</label><div class="controls">',
											'after'=>$this->Form->error('slug', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false, 'class'=>'form-control'));?></div>
							<!--Descripcion-->
							<?php echo $this->Form->input('description', array('type'=>'textarea','rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese una breve descripción del nivel taxonómico ingresado. Campo de texto expandible',
											'before'=>'<label class="control-label">'.__('Descripción').'</label><div class="controls">',
											'after'=>$this->Form->error('description', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
											'error' => array('attributes' => array('style' => 'display:none')),
											'label'=>false));?>
							<!--Published que tambien esta hidden-->
							<?php echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'hidden','value'=>'0','placeholder'=>'',
										'before'=>'<label class="control-label">'.__('Publicado').'</label><div class="controls">',
										'after'=>$this->Form->error('published', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
										'error' => array('attributes' => array('style' => 'display:none')),
										'label'=>false, 'class'=>''));
									// Este publis se asigno oculto debido a que la funcionalidad del plugin no esta clara.
								?>
							<br>
   							<div id="hide">
								<div class="familia box">
									<?php echo $this->Form->input('Family.0.id'); ?>		
									<?php echo $this->Form->input('Family.0.author', array('required' => false,'label'=>'Autor','class' => 'form-control','title'=>'Ingrese el nombre del autor del nivel taxonómico'));?>
									
									<?php echo $this->Form->input('Family.0.characteristic', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las características de la familia. Campo de texto expandible','label'=>'Características'));?>

								
									<?php echo $this->Form->input('Family.0.bibliography', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las referencias bibliográficas de la familia. Campo de texto expandible','label'=>'Bibliografía'));?>

									<?php echo $this->Form->input('Family.0.habitat', array('required' => false,'label'=>'Hábitat','class' => 'form-control','title'=>'Ingrese el nombre del habitad del nivel taxonómico'));?>
								
									<?php echo $this->Form->input('Family.0.globaldistribution', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la distribución global del nivel taxonómico. Campo de texto expandible','label'=>'Distribucion global'));?>
				
									<?php echo $this->Form->input('Family.0.observation', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las observaciones del nivel taxonómico. Campo de texto expandible','label'=>'Observaciones'));?>
									<br>

								</div>
								<div class="genero box">
									<?php echo $this->Form->input('Gender.0.id'); ?>	
									<?php echo $this->Form->input('Gender.0.author', array('required' => false,'label'=>'Autor','class' => 'form-control','title'=>'Ingrese el nombre del autor del nivel taxonómico'));?>
									
									<?php echo $this->Form->input('Gender.0.characteristic', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las características de la familia. Campo de texto expandible','label'=>'Características'));?>

								
									<?php echo $this->Form->input('Gender.0.bibliography', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las referencias bibliográficas de la familia. Campo de texto expandible','label'=>'Bibliografía'));?>

									<?php echo $this->Form->input('Gender.0.habitat', array('required' => false,'label'=>'Hábitat','class' => 'form-control','title'=>'Ingrese el nombre del habitad del nivel taxonómico'));?>
								
									<?php echo $this->Form->input('Gender.0.globaldistribution', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la distribución global del nivel taxonómico. Campo de texto expandible','label'=>'Distribucion global'));?>
									
									<?php echo $this->Form->input('Gender.0.countrygender', array('required' => false,'label'=>'Países','type' => 'select','multiple' => 'checkbox', 'options' => array(
																									'belize' => 'Belice',
                                                                                                    'costa_rica' => 'Costa Rica',
                                                                                                    'el_salvador' => 'El Salvador',
                                                                                                    'guatemala' => 'Guatemala',
                                                                                                    'honduras' => 'Honduras',
                                                                                                    'mexico' => 'México',
                                                                                                    'nicaragua' => 'Nicaragua',
                                                                                                    'panama' => 'Panamá'))) ?>
				
									<?php echo $this->Form->input('Gender.0.observation', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las observaciones del nivel taxonómico. Campo de texto expandible','label'=>'Observaciones'));?>
									
									<?php echo $this->Form->input('Gender.0.biologyandecology', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la información sobre biología y ecología del nivel taxonómico. Campo de texto expandible','label'=>'Biologia y ecologia'));?>
									<small><div class="col-lg-16 col-sm-32"><p aling ="left"><i><a data-toggle="modal" data-target="#modalFiles">Agregar archivo de especies</a></i></p></div></small>
	
									
									<br>
									
								</div>
							</div>
							
						</fieldset>
						<?php echo $this->Form->end(array('label'=>'Crear Taxón', 'class'=>'btn btn-primary')); ?>
							<br>
							<br>
						</div>

						<!--</div>-->
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
	</body>
	<div id="modalFiles" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="col-md-6">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4>Agregar archivo de especies</h4>
		      </div>
		      <div class="modal-body">
		      		<?php echo $this->Form->create('Download', array('enctype'=>'multipart/form-data', 'url'=>'../downloads/add2')); ?>
		        		<div title = "En este campo por favor introduzca un título para el archivo"><?php echo $this->Form->input('title', array('class'=>'form-control','label'=>'Título:','placeholder' => 'Título',));?></div>
						<div title = "En este campo por favor introduzca su primer apellido"><?php echo $this->Form->input('description', array('class'=>'form-control','label'=>'Descripción:','placeholder' => 'Descripción'));?></div>
						<div title = "En este campo por favor introduzca su segundo apellido"><?php echo $this->Form->input('report', array('type'=>'file','label'=>'Archivo:','placeholder' => 'Archivo'));?></div>
						<!--<?php echo $this->Form->input('classification', array('default'=>$this->request->data['Category']['classification'], 'type'=>'hidden'));?>-->
						<!--<?php echo $this->Form->input('category_id', array('default'=>$this->request->data['Category']['id'], 'type'=>'hidden'));?>-->
		      </div>
		      <div class="modal-footer">
		        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Guardar cambios</button>-->
		        <?php echo $this->Form->end(array('label'=>'Guardar', 'controller'=>'Downloads','action'=>'add2', 'class'=>'btn btn-success')); ?>
		      </div>
		    </div>
		
		  </div>
		</div>
</div>
	
	
