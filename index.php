<?php 
$pincel="";
$tab=20;
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>proyecto1</title>
</head>
<body>
<link rel="stylesheet" href="estilo.css">
	<hr>
		<?php 
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
				$izquierda='<div class="lineaI">';
				$centro='<div class="lineaC">';
				$derecha='<div class="lineaR">';
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
									$pincel.=$izquierda;
									$pincel.='<img src="img/jpeg.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.=$centro;
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.=$derecha;
									$pincel.='<a href="index.php?amplia='.$elemento.'">';
									//$pincel.='<a href="index.php?amplia='.$directorio.'/'.$elemento.'">';
									//$pincel.='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'>';
									$pincel.=$pintaIcono;
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
									$pincel.=$izquierda;
									$pincel.='<img src="img/png.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.=$centro;
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.=$derecha;
									$pincel.='<a href="index.php?amplia='.$directorio.'/'.$elemento.'">';
									//$pincel.='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'">';
									$pincel.=$pintaIcono;
									$pincel.='</a>';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								case 'docx':
									$pincel.='<div  class="cajaLinea">';
									$pincel.=$izquierda;
									$pincel.='<img src="img/word.jpg" height="40" length="40">';
									$pincel.='</div>';
									$pincel.=$centro;
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									//$pincel.='<div length="20%">';
									$pincel.=$derecha;
									$pincel.='<a href="docs/'.$elemento.'">  descargar ';
									$pincel.='</a>';
									$pincel.='</div>';
									$pincel.='</div>';
									break;
								case 'txt':
									$pincel.='<div  class="cajaLinea">';
									$pincel.=$izquierda;
									$pincel.='<img src="img/txt.png" height="40" length="40">';
									$pincel.='</div>';
									$pincel.=$centro;
									$pincel.=' - - '.$elemento;
									$pincel.='</div>';
									$pincel.=$derecha;
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
			echo $pincel;
		 ?>

	</hr>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</body>
</html>