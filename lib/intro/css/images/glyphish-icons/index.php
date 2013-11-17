<html>
<head>
<meta charset="utf-8" />
<title>Lista de Arquivos</title>
</head>
<body>
<?php
// Abre o diretório
$folder = opendir("./");
// Loop pelos arquivos do diretório
while (($entry = readdir($folder)) != "") {
$f[] = $entry;
}
// Fecha o diretório
$folder = closedir($folder);

/*
echo "<div style=' position:absolute; top: 100px; left: 200px;'><h1>Antes do Sort</h1><pre>";
print_r($f);
echo '</pre></div>';
*/
sort($f);
/*
echo "<div style=' position:absolute; top: 100px; right: 200px;'><h1>Depois do Sort</h1><pre>";
print_r($f);
echo '</pre></div>';
*/

echo '<div style="text-align: center;"><h1>Lista de Arquivos</h1>';
foreach($f as $item)
{
	echo '<a style="text-decoration:none;" href="'.$item.'">'.$item.'</a><br/>';
}
echo '</div>';
?>
<div align="center">
<a href="http://jsfiddle.net/" target="_blank">
<img src="http://www.redrails.com.br/wp-content/uploads/2013/09/jsfiddle-logo1.png"/>
</a>
</div>
</body>
</html>
