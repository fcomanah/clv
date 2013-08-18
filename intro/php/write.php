<html>
<head>
<title>Escrever em um arquivo de texto</title>
</head>
<body>
<?php
// Abre o arquivo de texto
$f = fopen("textfile.txt", "w");
// Escreve no arquivo de texto
fwrite($f, "Give me a lever long enough and a fulcrum on which to place it, and I shall move the world."); 
// Fecha o arquivo de texto
fclose($f);
// Redireciona para o arquivo read.php
header("Location: read.php");
?>
</body>
</html>
