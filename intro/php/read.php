<html>
<head>
<title>Ler um arquivo de texto</title>
</head>
<body>
<?php
$f = fopen("textfile.txt", "r");
// Lê cada uma das linhas do arquivo
while(!feof($f)) { echo fgets($f) . "<br />"; }
fclose($f);
?>
</body>
</html>
