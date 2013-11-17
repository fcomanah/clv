<html>
<head>
<meta charset="utf-8" />
<title>Sistema de arquivos</title>
</head>
<body>
<?php
// Pesquisar e escrever propriedades
echo "<h1>Arquivo: files.php</h1>";
echo "<p>Editado pela última vez em: " . date("r", filemtime("files.php")); 
echo "<p>Aberto pela última vez em: " . date("r", fileatime("files.php")); 
echo "<p>Tamanho do arquivo: " . filesize("files.php") . " bytes";
?>
</body>
</html>
