<option>Seleccione una familia</option>
<?php
//Reciben el id de la variable en cuestión.
foreach ($family as $id => $value) {
    echo '<option value="'.$id.'">'.$value.'</option>';
}

