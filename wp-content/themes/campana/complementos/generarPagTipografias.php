<html>
<?php
function listar_directorios_ruta($ruta){ 
   // crear archivo css a escribir 
   $arch = fopen("tipografias.css", "w");
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) { 
      if ($dh = opendir($ruta)) { 
         while (($file = readdir($dh)) !== false) { 
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $ruta$file : Es un: " . filetype($ruta . $file); 
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
               //solo si el archivo es un directorio, distinto que "." y ".." 			   
				if ($dh2 = opendir($ruta . $file)) {
					while (($file2 = readdir($dh2)) !== false) {
						if (is_dir($ruta . $file . $file2) == FALSE && $file!="." && $file!=".."){
							$file2Cortado = substr($file2, 0, -4);
							echo "@font-face {<br>font-family: $file2Cortado;<br>src: url($ruta$file/$file2);<br>}<br><br>"; 
							fwrite($arch, "@font-face {" . PHP_EOL);
							fwrite($arch, "font-family: $file2Cortado;" . PHP_EOL);
							fwrite($arch, "src: url($ruta$file/$file2);" . PHP_EOL);
							fwrite($arch, "}" . PHP_EOL);
							fwrite($arch, "" . PHP_EOL);
						}
					}
				}
			closedir($dh2);
            } 
         } 
      closedir($dh); 
      } 
	fclose($arch);
   }else 
      echo "<br>No es ruta valida"; 
}


listar_directorios_ruta("../tipografias/");
?>
</html>

