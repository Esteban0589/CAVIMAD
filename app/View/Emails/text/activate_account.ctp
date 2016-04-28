<!--?php echo $content_for_layout; ?-->
<h1>CAVIMAD</h1>

<p>Hola <?php echo $user_data['name']; ?>, bienvenido(a) a CAVIMAD! Ingrese al siguiente link para activar su cuenta:


<a href="<?php echo $user_data['ms']; ?>">Activar mi cuenta</a><br></p>
<p>O si lo prefiere, copie y pegue la siguiente dirección en su navegador:
<br>
<?php echo $user_data['ms']; ?><br></p>