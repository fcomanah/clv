<html>
<head>
<title>Ler um arquivo de texto</title>
</head>
<body>
<h1>101 EASY WAYS TO SAY NO</h1>
<p>I'd love to, but...</p>
<ol>
<?php
$f = fopen("101nos.txt", "r");
// Lê cada uma das linhas do arquivo
while (!feof($f)) { 
// Criando um array de arrays com o separador traço
$arrF[] = explode("-",fgets($f)); 
}
foreach($arrF as $F)
{
/* O item F é um array na primeira posicao 0 temos o número
 * e na segunda 1, temos a frase. Colocamos um teste a mais.
 * imprime-se na tela apenas se o conteúdo da segunda 
 * posição do array não for vazio.
 */
if (!empty($F[1])) echo "<li> $F[1] </li>"; 
}
fclose($f);
?>
</ol>
</body>
</html>
