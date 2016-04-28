<!--?php echo $content_for_layout; ?-->

<h1>CAVIMAD</h1>

<p>Hola <?php echo $user_data['name']; ?>, recibimos su solicitud para cambiar su contraseña. Por favor, presione el siguiente enlace:
<br>

<a href="<?php echo $user_data['ms']; ?>>">Reiniciar su contraseña</a><br></p>


<p>O si lo prefiere, copie y pegue la siguiente dirección en su navegador:
<br>
<?php echo $user_data['ms']; ?><br></p>