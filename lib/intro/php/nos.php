<html>
<head>
<meta charset="utf-8" />
<title>Ler um arquivo de texto</title>
</head>
<body>
<h1>101 EASY WAYS TO SAY NO</h1>
<p>I'd love to, but...</p>
<?php
$f = fopen("101nos.txt", "r");
// Lê uma linha e escreve no cliente
echo fgets($f). "<br />"; 
// Lê cada uma das linhas do arquivo
while(!feof($f)) { echo fgets($f) . "<br />"; }
fclose($f);
?>
</body>
</html>
