<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="estilo.css">
	<meta charset="UTF-8">
	<?php 

			$elemento="";
			$directorio="docs";
			$Maxlen=0;
			$pincel="";
			$tab=20;
			$ampliar="";
			//resource opendir ( string $path [, resource $context ] )
			if ($dir=opendir($directorio))//devuelve true a la asignacion
			{
				//mido el elemento mas grande y se guarda en Maxlen
				while($elemento=readdir($dir))//mientra lea
				{	
					if(is_file("$directorio/$elemento"))
					{	
						$Maxlen=(strlen($elemento)>$Maxlen)?strlen($elemento):$Maxlen;//toma el num mayor
					}
				}
				$Maxlen+=$tab;
			}
			rewinddir();
			if ($dir=opendir($directorio))//devuelve true a la asignacion
			{
				//mido el elemento mas grande y se guarda en Maxlen
				while($elemento=readdir($dir))//mientra lea
				{	
					if(is_file("$directorio/$elemento"))
					{	
						$trozos=explode('.',$elemento);
						$cola=$trozos[count($trozos)-1];
						//$ampliar=' height="100" length="100" ';
						$ampliar=' height="50" length="50" ';
						//$ampliar=' class="imagenNormal" ';
						//$ampliar=' class="imagenFlotante" ';
						$pintaIcono='<img src="'.$directorio.'/'.$elemento.'" '.$ampliar.'>';

						switch ($cola) 
							{
								case 'jpg':
									$pincel.=$pintaIcono;
									break;
								default: 
									break;
							}
					}
				}
			}
		echo $pincel;	
	 ?>
	<title>Document</title>
</head>
<body>
	
</body>
</html>