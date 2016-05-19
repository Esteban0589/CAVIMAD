<option>Seleccione un género</option>
<?php
//Reciben el id de la variable en cuestión.
foreach ($genre as $idg => $value) {
    echo '<option value="'.$idg.'">'.$value.'</option>';
}

