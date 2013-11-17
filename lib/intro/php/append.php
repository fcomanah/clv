<html>
<head>
<title>Escrever em um arquivo de texto</title>
</head>
<body>
<?php
if(isset($_POST['textblock']))
{
// Abre o arquivo de texto
$f = fopen("textfile.txt", "a");
// Escreve um texto
fwrite($f, '<br/>'.$_POST['textblock']); 
// Fecha o arquivo de texto
fclose($f);
// Redireciona para o arquivo read.php
header("Location: read.php");
}
else
{
?>
<form action="append.php" method="post">
<div><textarea rows="1" cols="100" name="textblock" placeholder="Enter here your phrase."></textarea></div>
<input type="submit" value="Submit">
</form>
<?php
}
?>
</body>
</html>
