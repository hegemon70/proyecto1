<?php 
$pincel="";
$pincelDir="";
$newDir="";
$dirBase="docs";
$dirActual=$dirBase;
$dirLevel=0;
$tab=20;
$debug=false;
$elemento="";
$directorio="";

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>proyecto1</title>
	<?php /*script de lecturas*/
			$elemento="";
			//$directorio=isset($_GET["changeDir"])?$dirActual+'/'+$_GET["changeDir"]:$dirActual;
			if (isset($_GET["changeDir"]))
			{	
				echo "entra en el cambio de directorio| ";
				if($_GET["changeDir"]=='..')
				{
					if($dirLevel!=0)//no es el directorio Raiz
					echo"pero como es raiz no hace nada|";
					$directorio=$dirBase;
				}
				else
				{
					$temp=$_GET["changeDir"];
					$directorio=$dirActual.'/'.$temp;
				}

				
				
			}
			else{
				echo "NO entra en el cambio de directorio";
				$directorio=$dirActual;
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
								//$pincel.="index.php?changeDir=";
								//$pincel.=$dir.'?changeDir=';
								//$pincel.='<a href="$dir/?changeDir=';
								//$pincel.=$elemento;
								//$pincel.='> c';
								//$pincel.='<a href="$dir/?changeDir='.$elemento.'> c';
								$pincel.='</a>';
								$pincel.='</div>';
								$pincel.='</div>';
							}
						}
					}
					else
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
		
		}/*fin else*/
	}/*fin while*/	
}/*fin fopen */
?>
<?php 
		/*script creacion directorio*/

		if(isset($_POST["carpeta"]))
		{	
			$directorio=$dirActual;
			$newDir=$_POST["carpeta"];


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
		if ($dirActual=='docs' && $dirLevel==0)//si estoy en el raiz
		{	
			echo "estoy en el directorio base |";
			if($_GET["changeDir"]!='..' )// y no intento bajar mas
			{
				$oldDir=$dirActual;
				$dirActual=$dirActual.'/'.$_GET["changeDir"];
				if(!chdir($dirActual))
				{
					echo "fallo al cambiar de directorio";
						//$_GET["changeDir"]=null;
				}
				else
				{
						
					$dirLevel++;
					echo "cambiado el directorio de ".$oldDir." al directorio ".$dirActual." nivel ".$dirLevel;
					//$_GET['dirActual']=$dirActual;
					//$_GET["changeDir"]=null;
				}
				
			}
			else //directorio base
			{
				echo "no puedes ir mas atras";
				//$_GET["changeDir"]=$dirBase;
			}
		
		}
		else//no estoy en el raiz
		{

			if($_GET["changeDir"]=='..' )//intento bajar
			{
				$dirs[]=explode('/', $dirActual);
			
				
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

	<?php echo $pincel; ?>
	

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</body>
</html>