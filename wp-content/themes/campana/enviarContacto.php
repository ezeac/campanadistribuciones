<html>
<?php

$nombre=$_REQUEST["nombre"];
$email=$_REQUEST["email"];
$tel=$_REQUEST["tel"];
$mensaje=$_REQUEST["mensaje"];
$text = "";
$text .= "Nombre y Apellido: ".$nombre.". \n";
$text .= "Email: ".$email.". \n";
if ($tel != ""){
$text .= "Tel.: ".$tel.". \n";
}
else {
$text .= "Tel.: No deja. \n";
}
if ($mensaje != ""){
$text .= "Mensaje: ".$mensaje.". \n";
}
else {
$text .= "Mensaje: No deja. \n";
}
mail("gezeac@gmail.com", "DiezWeb Contacto $nombre", $text);

?>

<iframe style="display:none" src="http://www.diezweb.com.ar/wp-content/themes/diezweb/cargarEnBBDD.php?nombre=<?php echo $nombre; ?>&email=<?php echo $email; ?>&tel=<?php echo $tel; ?>&mensaje=<?php echo $mensaje; ?>&sitio=misitio"></iframe>

¡GRACIAS POR ESCRIBIRNOS!
En breve estaremos respondiendo tu consulta.

</html>