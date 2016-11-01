<?php 
$pincel="";
$tab=20;
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>proyecto1</title>
	
	<?php /*script de lecturas*/
			$elemento="";
			$directorio="docs";
			$Maxlen=0;
			//resource opendir ( string $path [, resource $context ] )
			if ($dir=opendir($directorio))//devuelve true a la asignacion
			{
				//mido el elemento mas grande y se guarda en Maxlen
				while($elemento=readdir($dir))//mientra lea
				{	
					if(is_file("$directorio/$elemento"))
					{
						$len=strlen($elemento);	
						$Maxlen=($len>$Maxlen)?$len:$Maxlen;//toma el num mayor
					}
				}
				$Maxlen+=$tab;
				rewinddir();
				//$izquierda='<div'.' class="lineaI"'.'>';
				$izquierda=' class="lineaL" ';
				$centro=' class="lineaC" ';
				$derecha=' class="lineaR" ';
				//leemos el directorio
				$toAmpliar=isset($_GET["amplia"])?$_GET["amplia"]:null;
						
						
				while($elemento=readdir($dir))//mientra lea
				{	
					$len=strlen($elemento);	
					if(is_file("$directorio/$elemento"))
					{
						$trozos=explode('.',$elemento);
						$cola=$trozos[count($trozos)-1];
							switch ($cola) 
							{
								case 'jpg':
									if(!is_null($toAmpliar))//pulsado dibujo
									{
										if(($elemento)==$toAmpliar)//el dibujo pulsado coincide
										{
											$ampliar='height="500" length="500"';
										}
										else //el dibujo pulsado no coincide
										{
											$ampliar='height="75" length="75"';
										}	
									}
									else //sin pulsar dibujo
									{
										$ampliar='height="75" length="75"';
									}
									$pintaIcono='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'>';
									//$pincel.='<h1>'.$directorio.'/'.$elemento.'|'.$ampliar.'</h1>';
									$pincel.='<div class="cajaLinea">';
									//$pincel.='<div'.$izquierda.'>';
									$pincel.='<div class="lineaL">';
									$pincel.='<img src="img/jpeg.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.='<div class="lineaC">';
									//$pincel.='<div'.$centro.'>';
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.='<div class="lineaR">';
									//$pincel.='<div'.$derecha.'>';
									$pincel.='<a href="index.php?amplia='.$elemento.'">';
									//$pincel.='<a href="index.php?amplia='.$directorio.'/'.$elemento.'">';
									//$pincel.='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'>';
									$pincel.=$pintaIcono;

									$pincel.='</a>';
									$pincel.='es';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								case 'png':
									if(!is_null($toAmpliar))//pulsado dibujo
									{
										if(($elemento)==$toAmpliar)//el dibujo pulsado coincide
										{
											$ampliar='height="500" length="500"';
										}
										else //el dibujo pulsado no coincide
										{
											$ampliar='height="75" length="75"';
										}	
									}
									else //sin pulsar dibujo
									{
										$ampliar='height="75" length="75"';
									}
									$pintaIcono='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'>';
									$pincel.='<div class="cajaLinea">';
									$pincel.='<div'.$izquierda.'>';
									$pincel.='<img src="img/png.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.='<div'.$centro.'>';
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.='<div'.$derecha.'>';
									$pincel.='<a href="index.php?amplia='.$directorio.'/'.$elemento.'">';
									//$pincel.='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'">';
									$pincel.=$pintaIcono;
									$pincel.='</a>';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								case 'docx':
									$pincel.='<div  class="cajaLinea">';
									$pincel.='<div'.$izquierda.'>';
									$pincel.='<img src="img/word.jpg" height="40" length="40">';
									$pincel.='</div>';
									$pincel.='<div'.$centro.$Maxlen.'>';
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									//$pincel.='<div length="20%">';
									$pincel.='<div'.$derecha.'>';
									$pincel.='<a href="docs/'.$elemento.'">  descargar ';
									$pincel.='</a>';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								case 'txt':
									$pincel.='<div  class="cajaLinea">';
									$pincel.='<div'.$izquierda.'>';
									$pincel.='<img src="img/txt.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.='<div'.$centro.$Maxlen.'>';
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.='<div'.$derecha.'>';
									$pincel.='<a href="docs/'.$elemento.'">  ver ';
									$pincel.='</a>';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								default:
									$pincel.='<div>fallo';
									$pincel.='</div>';
									break;
							}
					}
				}
			}

			
?>

</head>
<body>
<link rel="stylesheet" href="estilo1.css">

<?php /*script de breadcrumb y creacion directorio*/
	$bc="";
	$bc.='<div><h1>'.'/'.$directorio.'</h1></div>';

?>
	<hr/>
		<form action="index.php" method="post" enctype="multipart/form-data"> <!-- es necesario hacerlo post y poner el  enctype="multipart/form-data" -->
		
<!-- 		<input type="file" name="imagen"> -->
	<table>
		
		<tr>
			<td><input type="submit" name="crearDir" value="crea Directorio">
Directorio<input type="text" name="carpeta">
			</td>
		<!-- 	<td></td> -->
			<!-- <td></td> -->
		</tr>
	<tr>
		<td><input type="file" name="imagen"><!-- </td>
		<td> -->
		<input type="submit" name="subir" value="subir"></td>
		<!-- <td></td> -->
	</tr>
	</table>
<?php /*script de subir*/
if (isset($_POST["subir"]))
{
	if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){
	//si venimos de pulsar el boton subir
		echo $directorio;
		echo '<br>'.$_FILES["imagen"]["name"];
		echo '<br>'.$_FILES["imagen"]["size"];
		echo '<br>'.$_FILES["imagen"]["type"];//tipo mime
		echo '<br>'.$_FILES["imagen"]["tmp_name"];//nombre temporal con el que se sube el fichero
		//$nombre=time().'_'.$_FILES["imagen"]["name"];
		$nombre=$_FILES["imagen"]["name"];	


	if(($_FILES["imagen"]["type"]=="image/jpeg")||$_FILES["imagen"]["type"]=="image/gif")
			move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio.'/'.$nombre);//origen el temporal, destino un timestamp + el nombre del archivo 
			//move_uploaded_file($_FILES["imagen"]["tmp_name"], "img/".$nombre);
	}else{
		echo "solo se pueden subir jpg y gif";
	}
}

 ?>

	</form>
	<hr/>
	<?php echo $bc ?>
	<hr/>

<?php echo $pincel; ?>
	

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</body>
</html>