<html>
<head>
<meta charset="utf-8" />
<title>Sistema de Arquivos</title>
</head>
<body>
<?php
// Abre o diretório
$folder = opendir("../html/");
// Loop pelos arquivos do diretório
while (($entry = readdir($folder)) != "") {
echo $entry . "<br />";
}
// Fecha o diretório
$folder = closedir($folder);
?>
</body>
</html>
