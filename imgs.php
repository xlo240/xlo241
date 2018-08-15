<?php
session_start();
if(!isset($_SESSION['auth'])) {
	echo "Закрытая зона"; exit();
}	

if ($_SESSION['auth'] != $_COOKIE['session_cook'])
{
echo "Закрытая страница. <a href='/'>Назад</a>";
exit();
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
</head>

<body bgcolor="#ccc">
<?php

echo "Welcome, ".$_COOKIE['login_cook']; //полчение кукисов  
?>

<p align="center"><a href="str2.php">Назад</a> <a href="exit.php">ВЫХОД</a></p>
<table align="center" border="1">
<tr>
<td></td>
<td></td>
</tr>
</table>
<?php

/*****************/
function get_filesize($file){
	if(!file_exists($file)) return "Файл  не найден";
	$filesize = filesize($file);
	$filesize = ($filesize/1024);
	if($filesize > 3072){//если более 3 мб
		if($filesize > 1024){
			$filesize = ($filesize/1024);
			if($filesize > 1024) {
				$filesize = ($filesize/1024);
				$filesize = round($filesize, 1);
				return $filesize." ГБ";       
			} else {
				$filesize = round($filesize, 1);
				return $filesize." MБ";   
			}       
		}
	}
}



function recursive($dir){
	static $deep = 0;
	$odir = opendir($dir);

	while (($file = readdir($odir)) !== FALSE){
		if ($file == '.' || $file == '..'){
			continue;
		}
		else {
			//echo ($path = $dir.DIRECTORY_SEPARATOR.$file).'<br>';
			$path2 = realpath($dir.DIRECTORY_SEPARATOR.$file);
			//echo $path2;
			$size = getimagesize($path2);
			 
			if($size !==false){//Это графический файл
				//echo "Это графический файл<br>";
				$file_size = get_filesize($path2); 
				
				if($file_size != NULL){//если больше 3 Мб
					echo "Путь: ".$path2."<br>";
					echo "Размер файла: ".$file_size."<br>";
					echo "<hr>";
				}
				/*
				else {
					echo "малый файл<br>";
					echo "Путь: ".$path2."<br>";
				}
				*/
				
			}
			/*
			else {
				echo "Не картинка ".$size[2]."<br>";
				echo "Путь: ".$path2."<br>";
			}
			*/
		
		}
	 
		if (is_dir($dir.DIRECTORY_SEPARATOR.$file)){
			 $deep ++;
			 recursive($dir.DIRECTORY_SEPARATOR.$file);
			 $deep --;
		}
	}
    closedir($odir);
}
$dir = "img";//папка с вложенными файлами и папками
recursive($dir);

?>

</body>
</html>
