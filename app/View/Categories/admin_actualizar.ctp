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
   						if ($("#drop1 :selected").text() == 'Género' ) {
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
<h4>El padre seleccionado es:  <?php if($parent['Category']['classification'] == 'Familia'){ echo '<i>'; echo $parent['Category']['name']; echo'</i>';} 
   else{ echo $parent['Category']['name'];}?></h4>
<?php echo $this->Form->input('parent_id', array('div'=>'control-group','placeholder'=>'','default'=>$parent['Category']['id'],
   'empty'=>array('0'=>__('Root')),
   'before'=>'<label class="control-label">'.__('Padre').'</label><div class="controls">', 'type' => 'hidden',
   'after'=>$this->Form->error('parent_id', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
   'label'=>false, 'class'=>'form-control'));?></div>
<?php echo $this->Form->input('classification', array('div'=>'control-group','id'=>'drop1','placeholder'=>'','options'=>$classification,
   'before'=>'<label class="control-label">'.__('Clasificación').'</label><div class="controls">',
   'after'=>$this->Form->error('classification', array(), array('wrap' => 'span', 'class' => 'error-message')).'</div>',
   'error' => array('attributes' => array('style' => 'display:none')),
   'label'=>false, 'class'=>'form-control'));?>