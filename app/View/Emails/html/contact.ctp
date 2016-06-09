<h1>Fórmula de contacto</h1>
<h3><p><?php echo $user_data['name'];?> cuyo correo es <i><?php echo $user_data['from'];?>,</i> y su teléfono <i><?php if(empty($user_data['phone'])){ echo '<i>la persona no añadió un número telefónico</i>';}else{echo $user_data['phone'];}?></i>,  envío el siguiente comentario:</p></h3>
<p align =  "justify"><i><?php echo nl2br($user_data['body']);?></p></i>