<?php 
$pincel="";
$pincelDir="";
$newDir="";
$dirBase="docs";
$directorio=$dirBase;
$dirLevel=0;
$tab=20;
$debug=true;
$elemento="";
//$dirActual="";
$pathCompleto="";

 ?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>proyecto1</title>
	<?php /*script de lecturas*/
$GLOBALS["pathServidor"]=isset($GLOBALS["pathServidor"])?$GLOBALS["pathServidor"]:getcwd();
$GLOBALS["pathActual"]=isset($GLOBALS["pathActual"])?$GLOBALS["pathActual"]:getcwd();
$elemento="";

//$directorio=isset($_GET["dirActual"])?$directorio.'/'.$_GET["dirActual"]:$directorio;
//$directorio=isset($_GET["changeDir"])?$directorio.'/'.$_GET["changeDir"]:$directorio;
//$dirActual=($directorio==$dirBase)?$dirBase:$dirActual;//primer caso

if($debug)
{
	echo "este es mi path de servidor ".$GLOBALS["pathServidor"];
	echo "<br/>";
	echo "este es mi path real ".$GLOBALS["pathActual"];
	echo "<br/>";
	echo getcwd();
	$var = explode("\\",getcwd());
	echo "<br/>";
	echo "este es mi directorio real ".$var[count($var)-1];
	echo "<br/>";
	echo "| estoy en el inicio";
/*	echo "<br/>";
	echo "| el dirActual es : $dirActual ";*/
	echo "<br/>";
	echo "|  el valor de directorio es : $directorio ";
	echo "<br/>";
				/*
				if(isset($_GET["changeDir"]))	
					echo "|la variable globals[dirActual] tiene el valor de :".$_GET["changeDir"];
				else echo "|la variable globals[dirActual] esta sin definir";
				echo "<br/>";
				if(isset($GLOBALS["dirLevel"]))
					echo "|la variable globals[level teien el valor de :".$GLOBALS["dirLevel"];
				else 
					echo "|la variable globals[dirLevel] esta sin definir ";
				echo "<br/>";
				//var_dump($dirActual);*/

}

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
		if(is_dir("$directorio/$elemento"))/*inicio es directorio*/
		{
			if ($elemento!='.')//si no es el directorio . 
			{
				if(($elemento=='..')&&($dirLevel==0))//si es .. en base
				{
						//no hago nada, no muestro el ..
				}
				else
				{
					$pintaIcono='<img src="'.$directorio.'/'.$elemento.'>';
					$pincel.='<div class="cajaLinea">';
					//$pincel.='<div'.$izquierda.'>';
					$pincel.='<div class="lineaL">';
					$pincel.='<img src="img/directorio.png" height="40" length="40">';
					$pincel.='</div>';
					$pincel.='<div class="lineaC">';
					//$pincel.='<div'.$centro.'>';
					$pincel.=' - - '.$elemento;
					$pincel.='</div>';
					$pincel.='<div class="lineaR">';
					//$pincel.='<a href="';
					$pincel.='<a href="index.php?changeDir='.$elemento.'"> cambio a directorio';
					$pincel.='</a>';
					$pincel.='</div>';
					$pincel.='</div>';
				}
			}
		}
		else//si no es directorio
		{
			if(is_file("$directorio/$elemento"))
			{/*inicio is_file*/
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
						// $pincel.='es';
						$pincel.='<a href="index.php?borrar='.$elemento.'">';//para borrar
						$pincel.='<img src="img/delete.png"  height="10" >';
						$pincel.='</a>';
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
				}/*fin switch*/
			}/*fin is_file  */
		
		}/*fin else no es directorio*/
	}/*fin while*/	
}/*fin fopen */
?>
<?php 
		/*script creacion directorio*/

		if(isset($_POST["carpeta"]))
		{	

			//$directorio=$dirActual;
			$newDir=$_POST["carpeta"];
			if($debug)
				echo "este es el valor de directorio"+var_dump($directorio);

			if(strlen($newDir)==0)
			{
				$pincelDir.="introduce el nombre del directorio en Campo Directorio";
			}
			else
			{
					$path=$directorio.'/'.$newDir;
					if($debug)
						echo '<h2>'.$path.'</h2>';
					if(mkdir($path))
					{
							$pincelDir.="directorioCreado: ".$directorio.'/'.$newDir;
							$_GET["changeDir"]=$newDir; //preparo elcambio al nuevo directorio
					}
					else
					{
							$pincelDir.="creacion directorio fallida ";
					}
			}

		}//fin esta cargada la variable carpeta??
	
?>
<?php 
	/*cambiar directorio*/
	if(isset($_GET["changeDir"]))
	{	
		/*if($debug)
		{
				echo "estoy en el inicio de cambiar directorio";
				echo "<br/>";
				echo "el valor de dirActual es:".$dirActual;
				echo "<br/>";
				echo "el valor de directorio es:".$directorio;
				echo "<br/>";
				echo "el valor de dirLevel es:".$dirLevel;
				echo "<br/>";
		}*/
		//if ($directorio==$dirBase)//si estoy en el raiz
		if ($directorio==$dirBase && $dirLevel==0)//si estoy en el raiz
		{	
			if($debug)
				echo "<br/>estoy en el directorio base |";
			if($_GET["changeDir"]!='..' )// y no intento bajar mas
			{
				$dirOrigen=$directorio;
				$dirDestino=$_GET["changeDir"];
				
					if($debug)
					{
						echo "<br/>";
						echo "estoy en el centro de cambiar directorio";
						echo "<br/>";
						echo "el valor de directorio es:".$directorio;
						echo "<br/>";
						echo "el valor de dirOrigen es:".$dirOrigen;
						echo "<br/>";
						echo "el valor de dirDestino es:".$dirDestino;
						echo "<br/>";
						echo "antes de cambiar de directorio estoy en ".getcwd();
					}
				if(is_dir("$dirOrigen/$dirDestino"))//si es un directorio real
				{
					if($debug)
					{
						echo "<br/>";
						echo "el directorio destino $dirDestino existe";
					}

					if(!chdir($directorio))//si falla el cambio de directorio
					{
						echo "fallo al cambiar de directorio";
					}
					else
					{	
						$dirLevel++;
						
						//$_GET["dirActual"]=$directorio.'/'.$dirDestino;
						$GLOBALS["pathActual"]=$directorio.'/'.$dirDestino;
						$directorio=$directorio.'/'.$dirDestino;
						if($debug){
							echo "<br/>";
							echo "cambiado el directorio de ".$dirOrigen." al directorio ".$dirDestino." nivel ".$dirLevel."estoy en :".getcwd();
							echo "<br/>";
							echo "pathActual es ".$GLOBALS["pathActual"];
							echo "<br/>";
							echo "directorio es $directorio ";
						}
					}
				}
				//$directorio=$directorio.'/'.$_GET["changeDir"];
				
				
			}
			else //directorio base
			{
				echo "no puedes ir mas atras";
				//$_GET["changeDir"]=$dirBase;
			}
		
		}
		else//no estoy en el raiz
		{
			if($_GET["changeDir"]=='..' )//intento ir hacia atras
			{
					$dirs[]=explode('/', getcwd());//TODO
					$dirDestino=$dirs[count($dirs) -1];
					if(!chdir(".."))
					{
						echo "fallo al cambiar de directorio";
					}
					else
					{
						$directorio=$dirDestino;
					}
			}
			else//intento meterme en un subdirectorio
			{
				if($debug)
				{
					echo "<br/>";
					echo " intento meterme en un subdirectorio ";
				}
				
				$dirOrigen=$directorio;
				$dirDestino=$_GET["changeDir"];
				if(!chdir($directorio))
				{
					echo "fallo al cambiar de directorio";
						//$_GET["changeDir"]=null;
				}
				else
				{
						
					$dirLevel++;
					if($debug){
						echo "<br/>";
						echo "cambiado el directorio de ".$dirOrigen." al directorio ".$dirDestino." nivel ".$dirLevel."estoy en :".getcwd();
					}
						$directorio=$dirDestino;
						/*$GET["dirActual"]=$dirActual;
						$GET["dirLevel"]=$dirLevel;*/

				}
				
			}
			
		}
	
	}

	// else
	// 	$dirActual="docs";
 ?>
 <?php /*script borrar elmento*/
	if(isset($_GET["borrar"]))
	{
		$borrar=$_GET["borrar"];
		$ruta="$borrar";//FIXME
		if(is_file($ruta))
		{//si el fichero existe, 
			
			if(!unlink($ruta))
			{//lo intenta BORRAR
				echo "No se ha  podido borrar";//si falla muestra aviso
			}
			else
			{
				echo "archivo borrado";
				
			}
		}
		else
		{
			echo "fichero no encontrado";
		}

	}
 ?>
 <?php /*script de subir*/
	if (isset($_POST["subir"]))
	{/*esta definido subir*/
	//echo $_FILES["imagen"]["name"].'<br>tenemos cargado el post de subir<br>';
		if($debug)
		{//inicio debug
			$bc.=$directorio;
			$bc.='<br>'.$_FILES["imagen"]["name"];
			$bc.='<br>'.$_FILES["imagen"]["size"];
			$bc.='<br>'.$_FILES["imagen"]["type"];//tipo mime
			$bc.='<br>'.$_FILES["imagen"]["tmp_name"];
		}//fin debug
		if(is_uploaded_file($_FILES["imagen"]["tmp_name"]))
		{//si se ha subido el archivo
		
		//nombre temporal con el que se sube el fichero
			//$nombre=time().'_'.$_FILES["imagen"]["name"];
			$nombre=$_FILES["imagen"]["name"];	


			//if(($_FILES["imagen"]["type"]=="image/jpeg")||$_FILES["imagen"]["type"]=="image/png"){
			if(($_FILES["imagen"]["type"]=="image/jpeg")||
				($_FILES["imagen"]["type"]=="image/png")||
				($_FILES["imagen"]["type"]=="application/octet-stream")||
				($_FILES["imagen"]["type"]=="text/plain"))
			{//inicio comprobacion type archivos permitidos
					move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio.'/'.$nombre);//origen el temporal, destino un timestamp + el nombre del archivo 
					//move_uploaded_file($_FILES["imagen"]["tmp_name"], "img/".$nombre);
			}//fin comprobacion type archivos permitidos
			else//no son archivos de tipo permitido
			{
				echo "solo se pueden subir jpg y png";
			}//fin no son archivos de tipo permitido
		}//fin de si se ha subido el archivo
	}/*fin de esta definido subir*/
 ?>
 <?php /*script de breadcrumb */
	$bc="";
	$vBc=explode('/',$directorio);	
	//$bc.='el numero de nivel es: '.count($vBc);
	//$bc.='<div><h1>'.'/'.$directorio.'</h1></div>';
	$bc.='<ul class="breadcrumb">';
	//foreach ($vBc as $subDir) {
	if(count($vBc)>1)
	{/*si hay subdirectorios*/
		for ($i=0; $i < count($vBc); $i++) 
		{ //recorremos los subdirectorios
			$bc.='<li>';//abrimos inicio lista
			$bc.='<a href="?dir=';//abrimos enlace
			for ($j=0; $j <=$i; $j++) 
			{ //escribimos / y el siguiente subdirectorio
				$bc.='/';
				$bc.=$vBc[$j];
			}
			$bc.='">';
			$bc.=$vBc[$i];
			$bc.='</a>';
			$bc.='</li>';
		
		}//fin de for recorremos los subdirectorios
	}/*fin de si hay directorio*/
	else /*solo un directorio*/
	{
			$bc.='<li>';
			$bc.='<a href="?dir=';
			$bc.='docs';
			$bc.='">';
			$bc.='docs';
			$bc.='</a>';
			$bc.='</li>';
	}/*find de solo un directorio*/
	$bc.='</ul>';
?>

	


</head>
<body>

<link rel="stylesheet" href="estilo1.css">
	<hr/>
		<form action="index.php" method="post" enctype="multipart/form-data"> <!-- es necesario hacerlo post y poner el  enctype="multipart/form-data" -->
<!-- 		<input type="file" name="imagen"> -->
			<table>
				<tr>
					<td>
						<input type="submit" name="crearDir" value="crea Directorio">
							Directorio
						<input type="text" name="carpeta" value="">
					</td>
				<!-- 	<td></td> -->
					<!-- <td></td> -->
				</tr>
			<tr>
				<td>
					<input type="file" name="imagen">
					<input type="submit" name="subir" value="subir">
				</td>
				<!-- <td></td> -->
			</tr>
			</table>
	</form>
	<hr/>
	<?php echo $pincelDir;  ?>
	<?php echo $bc; ?>
	<hr/>

	<?php 
	echo $pincel; 
	$pincel="";
	?>

	

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</body>
</html>