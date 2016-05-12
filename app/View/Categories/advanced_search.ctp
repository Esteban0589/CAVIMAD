<div class="container">
   <div style="text-align: center">
      <?php echo $this->Form->create('Category', array('url' => 'advance_search')); ?>
      <div title = "Por favor, seleccione el tipo de búsqueda deseado." >
         <?php echo $this->Form->input('field', array('options' => array('Nivel Taxonómico', 'Documentos', 'Colaboradores'), 'empty' => 'Seleccione una opción', 'label'=>'Tipo de búsqueda'));?>
      </div>
      <div title = "Seleccione el orden, si lo conoce, al que pertenece su búsqueda. En este campo, puede dejar su selección vacía." >
         <?php echo $this->Form->input('field', array('options' => array(1, 2, 3, 4, 5), 'empty' => 'Seleccione una opción'));?>
      </div>
      <div title = "Seleccione la familia, si lo conoce, al que pertenece su búsqueda. En este campo, puede dejar su selección vacía." >
         <?php echo $this->Form->input('field', array('options' => array(1, 2, 3, 4, 5), 'empty' => 'Familia'));?>
      </div>
      <div title = "Seleccione el género, si lo conoce, al que pertenece su búsqueda. En este campo, puede dejar su selección vacía." >
         <?php echo $this->Form->input('field', array('options' => array(1, 2, 3, 4, 5), 'empty' => 'Género'));?>
      </div>
      <div title = "Seleccione el país correspondiente, si desea limitar su búsqueda a un territorio en específico. En este campo, puede dejar su selección vacía." >
         <?php echo $this->Form->input('field', array('options' => array(1, 2, 3, 4, 5), 'empty' => 'País'));?>
      </div>
      <div title = "Seleccione el tipo de documento del item al que pertenece su búsqueda." >
         <?php echo $this->Form->input('field', array('options' => array(1, 2, 3, 4, 5), 'empty' => 'Tipo de documento'));?>
      </div>
      <div tittle = "Escriba las palabras clave con las que desea hacer su búsqueda.">
          <?php echo $this->Form->input('username', array('label'=>' ','type'=>'text','placeholder' => 'Palabras clave', 'rows' => '1', 'cols' => '30'));?>
      </div>
      <?php echo $this->Form->end(); ?>
      <br>
   </div>
</div>
