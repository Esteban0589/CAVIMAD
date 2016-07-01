

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
<script type="text/javascript">
   function actualizar(id)
   {
   $.ajax({
   type: 'GET',
   url: 'admin/categories/actualizar/' + id,
   success: function (data) {
     //alert(id);
     $('#parent_id').html(data);
   },
   });
   }
</script>
<body onload="toggle_visibility_off()">
   <div id="k-body">
      <!-- content wrapper -->
      <div class="container">
         <!-- container -->
         <?php if($this->Session->read('Auth')['User']['role']=='Administrador'): ?> 
         <div class="row">
            <!-- row -->
            <div class="col-lg-12 col-md-12">
               <!-- doc body wrapper -->
               <!--<div class="categories form">-->
               <ul class="breadcrumb">
                  <li>
                     <!--Ruta del arbol-->
                     <?php echo $this->Html->link(__('Manejar niveles taxonómicos'), array('action'=>'index', 'alias'=>$alias));?>
                     <span class="divider">/</span>
                  </li>
                  <li class="active"><?php echo __('Agregar nuevo taxón'); ?></li>
               </ul>
               <?php echo $this->Html->css(array('/tree_menu/css/extjs/ext-all'));?>
               <?php echo $this->Html->script(array('/tree_menu/js/extjs/ext-base','/tree_menu/js/extjs/ext-all'));?>
               <style type="text/css">
                  html, body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, p, blockquote, th, td {
                  padding: none;
                  }
               </style>
               <div id="k-body">
                  <!-- content wrapper -->
                  <div class="container">
                     <!-- container -->
                     <div class="row">
                        <!-- row -->
                        <!--Parte contenedora del arbol-->
                        <div class="col-lg-3 col-md-3">
                           <!-- doc body wrapper -->
                           <h2>Árbol Taxonómico</h2>
                           <script type="text/javascript">
                              //Ext.BLANK_IMAGE_URL = '<?php //echo $html->url('/js/ext-2.0.1/resources/images/default/s.gif') ?>';
                              
                              Ext.onReady(function(){
                              
                                  var getnodesUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/getnodes2/'.$alias);?>';
                                  var reorderUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/reorder/') ?>';
                                  var reparentUrl = '<?php echo $this->Html->url('/admin/tree_menu/categories/reparent/') ?>';
                              
                                  var Tree = Ext.tree;
                              
                                  var tree = new Tree.TreePanel({
                                      el:'tree-div',
                                      startCollapsed: false,
                                      autoScroll:true,
                                      animate:true,
                                      enableDD:false,
                                      containerScroll: true,
                                      rootVisible: false,
                                      loader: new Ext.tree.TreeLoader({
                                          dataUrl:getnodesUrl
                                      })
                                  });
                              
                                  var root = new Tree.AsyncTreeNode({
                                      text:'<?php echo __('Category');?>',
                                      draggable:false,
                                      id:'0'
                                  });
                                  tree.setRootNode(root);
                              
                                  tree.render();
                                  root.expand();
                              
                                  // track what nodes are moved and send to server to save
                              
                                  var oldPosition = null;
                                  var oldNextSibling = null;
                              
                                  tree.on('startdrag', function(tree, node, event){
                                      oldPosition = node.parentNode.indexOf(node);
                                      oldNextSibling = node.nextSibling;
                                  });
                              
                                  tree.on('movenode', function(tree, node, oldParent, newParent, position){
                              
                                      if (oldParent == newParent){
                                          var url = reorderUrl;
                                          var params = {'node':node.id, 'delta':(position-oldPosition)};
                                      } else {
                                          var url = reparentUrl;
                                          var params = {'node':node.id, 'parent':newParent.id, 'position':position};
                                      }
                              
                                      // we disable tree interaction until we've heard a response from the server
                                      // this prevents concurrent requests which could yield unusual results
                              
                                      tree.disable();
                              
                                      Ext.Ajax.request({
                                          url:url,
                                          params:params,
                                          success:function(response, request) {
                              
                                              // if the first char of our response is zero, then we fail the operation,
                                              // otherwise we re-enable the tree
                              
                                              if (response.responseText.charAt(0) != 1){
                                                  request.failure();
                                              } else {
                                                  tree.enable();
                                              }
                                          },
                                          failure:function() {
                              
                                              // we move the node back to where it was beforehand and
                                              // we suspendEvents() so that we don't get stuck in a possible infinite loop
                              
                                              tree.suspendEvents();
                                              oldParent.appendChild(node);
                                              if (oldNextSibling){
                                                  oldParent.insertBefore(node, oldNextSibling);
                                              }
                              
                                              tree.resumeEvents();
                                              tree.enable();
                              
                                              alert("Oh no! Your changes could not be saved!");
                                          }
                              
                                      });
                              
                                  });
                              });
                              
                           </script>
                           <div id="tree-div" title="Despliega los distintos niveles taxonómicos." style="height:400px;padding-top: 10px;"></div>
                           <br>
                        </div>
                        <!--Parte a refrescar-->
                        <a href="javascript:catalogo()" >
                        </a>
                        <div id="secciones" class="col-lg-9 col-md-9">
                           <?php echo $this->Form->create('Category', array('class'=>'form-horizontal','onsubmit' => "return confirm(\"Recuerde que la clasificación debe de tener congruencia con respecto a su padre\");", 'enctype'=>'multipart/form-data'));?>
                           <!--<div class="col col-sm-12" style=" padding-left: 0px;">-->
                           <div class="col-lg-6 col-md-6" >
                              <h2 >Agregar nuevo taxón</h2>
                              <fieldset>
                                 <!--Clasificacion-->
                                 <div title="Seleccione la clasificación del nuevo taxón">
                                    <div id="parent_id"> <i>Si desea añadir un nuevo filo, simplemente agregue el nombre y la descripción en los espacios indicados. De otra manera, debe de seleccionar el padre en el árbol taxonómico.<br><br></i> </div>
                                 </div>
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
                                       'label'=>false, 'class'=>'form-control'));?>
                                 </div>
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
                                       <?php echo $this->Form->input('Gender.0.observation', array('rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese las observaciones del nivel taxonómico. Campo de texto expandible','label'=>'Observaciones'));?>
                                       <?php echo $this->Form->input('Gender.0.biologyandecology', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese la información sobre biología y ecología del nivel taxonómico. Campo de texto expandible','label'=>'Biologia y ecologia'));?>
                                       <?php echo $this->Form->input('Gender.0.countrygender', array('required' => false,'label'=>'Países','type' => 'select','multiple' => 'checkbox', 'options' => array(
                                          'belize' => 'Belice',
                                                                                                  'costa_rica' => 'Costa Rica',
                                                                                                  'el_salvador' => 'El Salvador',
                                                                                                  'guatemala' => 'Guatemala',
                                                                                                  'honduras' => 'Honduras',
                                                                                                  'mexico' => 'México',
                                                                                                  'nicaragua' => 'Nicaragua',
                                                                                                  'panama' => 'Panamá'))) ?>
                                       <h4><?php echo __('Agregar archivo de especies'); ?></h4>
                                       <?php echo $this->Form->input('Gender.0.title', array('required' => false,'label'=>'Título','class' => 'form-control','title'=>'En este campo por favor introduzca un título para el archivo'));?>
                                       <?php echo $this->Form->input('Gender.0.description', array('required' => false,'rows' => '5', 'cols' => '5','class'=>'form-control','title'=>'Ingrese una descripción para el documento','label'=>'Descripción'));?>
                                       <?php echo $this->Form->input('Gender.0.report', array('type'=>'file','label'=>'Archivo:','placeholder' => 'Archivo'));?>
                                       <br>
                                    </div>
                                 </div>
                              </fieldset>
                              <?php echo $this->Form->end(array('label'=>'Crear Taxón', 'class'=>'btn btn-primary')); ?>
                              <br>
                              <br>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--'novalidate'=>'novalidate'-->
            <!--</div>-->
         </div>
      </div>
      <?php endif; ?>
      <?php if($this->Session->read('Auth')['User']['role']!='Administrador'): ?>
      <div class="alert alert-warning alert-dismissable">
         <p><strong>Upps!</strong> No puedes acceder a esta página.</p>
      </div>
      <?php endif; ?>     
   </div>
   </div>
</body>

