<script>
   //Este script se utiliza para esconder o mostrar secciones de dropdown según lo seleccionado.
   $(document).ready(function() {
   			$("#drop1").change(function() {
   
   						// $('#log').text("");
   							$(".box").hide();
   								var e = document.getElementById("hide");
      							 e.style.display = 'block';
   						
   						if ($("#drop1 :selected").text() == 'Colaboradores' ) {
   							$(".box").hide();
                      			$(".colaboradores").show();
                      			$(".submit").show();
                      			
   						}
   						if ($("#drop1 :selected").text() == 'Documentos' ) {
   							$(".box").hide();
                      			$(".documentos").show();
                      			$(".submit").show();
   						}
   							if ($("#drop1 :selected").text() == 'Nivel Taxonómico' ) {
   							$(".box").hide();
                      			$(".nivel").show();
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
<?php 		
   //Permite realizar la actualización del dropdown de familia según un orden seleccionado.
   //Obtiene el valor del dropdown order.
   $this->Js->get('#order');
   //Si este cambia.
   echo $this->Js->event('change', 
      //Realiza un request que actualiza la variable family. Para esto llama al método getDataFamily.
      $this->Js->request(array(
          'controller'=>'categories',
          'action'=>'getDataFamily'
          ), array(
          'update'=>'#family',
          'async' => true,
          'method' => 'post',
          'dataExpression'=>true,
          'data'=> $this->Js->serializeForm(array(
              'isForm' => true,
              'inline' => true
              ))
          ))
      );
   ?>
   
<?php 		
   //Permite realizar la actualización del dropdown de género según una familia seleccionada.
   //Obtiene el valor del dropdown family.
   $this->Js->get('#family');
   //Si este cambia.
      echo $this->Js->event('change', 
       //Realiza un request que actualiza la variable genre. Para esto llama al método getDataGenre.
      $this->Js->request(array(
          'controller'=>'categories',
          'action'=>'getDataGenre'
          ), array(
          'update'=>'#genre',
          'async' => true,
          'method' => 'post',
          'dataExpression'=>true,
          'data'=> $this->Js->serializeForm(array(
              'isForm' => true,
              'inline' => true
              ))
          ))
      );
   ?>
   

<div class="container"><!-- container -->

   <div class="row"><!-- row -->
         
   <h1>Búsqueda avanzada</h1>
   <?php echo $this->Form->create('Category', array('url'=>'redirect_to_methods')); ?>

<body onload="toggle_visibility_off()">
<div class = "col-md-4">
   
   <div title="Seleccione el tipo de búsqueda.">
      <?php echo $this->Form->input('drop1',array('empty'=>'Seleccione una opción','class'=>'form-control','options' => array('colaboradores' => 'Colaboradores', 'nivel'=>'Nivel Taxonómico'), 'id'=>'drop1', 'label' => 'Seleccione el tipo de búsqueda: '));?>
      <br>
      
   </div>
   <div id="hide">
      <div class="colaboradores box">
         <div title="Introduzca las palabras con las que desea hacer la búsqueda."><?php echo $this->Form->input('search1', array('placeholder' => 'Escriba las palabras clave','class'=>'form-control', 'label'=>'Búsqueda: '));?></div>
         <br>
         <?php echo $this->Form->end(array('label'=>'Buscar', 'class'=>'btn btn-success', 'title'=>'Busca los datos')); ?>
         <br>
      </div>
      <!--<div class="documentos box">-->
      <!--   <div title="Introduzca las palabras con las que desea hacer la búsqueda."><?php echo $this->Form->input('search2', array('placeholder' => 'Escriba las palabras clave','class'=>'form-control', 'label'=>'Búsqueda: '));?></div>-->
      <!--   <br>-->
      <!--   <?php echo $this->Form->end(array('label'=>'Buscar', 'class'=>'btn btn-success', 'title'=>'Busca los datos')); ?>-->
      <!--   <br>-->
      <!--</div>-->
      <div class="nivel box">
         
         <div title="Seleccione el orden por el que desea filtar la búsqueda."><?php echo $this->Form->input('order', array('empty' => 'Seleccione un orden','class'=>'form-control', 'options'=>$order, 'label'=>'Orden: '));?> </div>
         <br>
         <div title="Seleccione la familia por la que desea filtar la búsqueda."> <?php echo $this->Form->input('family', array('empty' => 'Seleccione una familia','class'=>'form-control', 'options'=>$family, 'label'=>'Familia: '));?></div>
         <br>
         <div title="Seleccione el género por el que desea filtar la búsqueda."><?php echo $this->Form->input('genre', array('empty' => 'Seleccione un género','class'=>'form-control', 'options'=>$genre, 'label'=>'Género: '));?></div>
         <br>
         <div title="Seleccione el país por el que desea filtar la búsqueda."><?php echo $this->Form->input('country', array('empty' => 'Seleccione un país','class'=>'form-control', 'options'=>array( 'belize'=>'Belice','costa_rica'=>'Costa Rica','el_salvador'=>'El Salvador', 'guatemala'=>'Guatemala', 'honduras'=>'Honduras','mexico'=>'México','nicaragua'=>'Nicaragua','panama'=>'Panamá'), 'label'=>'País: '));?></div>
         <br>
         <div title="Introduzca las palabras con las que desea hacer la búsqueda."><?php echo $this->Form->input('search3', array('placeholder' => 'Escriba las palabras clave','class'=>'form-control', 'label'=>'Búsqueda: '));?></div>
         <br>
         <?php echo $this->Form->end(array('label'=>'Buscar', 'class'=>'btn btn-success', 'title'=>'Busca los datos')); ?>
         <br>
      </div>
   </div>
</div>
<div class = "col-md-12">
</div>
</body>


      </div>
   </div>