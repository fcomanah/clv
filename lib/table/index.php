<html>
<head>
 <meta charset="utf-8">
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<h2>Transações</h2>

<table>
  <tr>
    <th>Nome</th>
    <th>Pagamento</th>
    <th>Valor</th>
  </tr>
  <tr>
    <td>Eunice</td>
    <td>Cartão</td>
    <td>R$100</td>
  </tr>

  <?php
    $f = fopen ("transacoes.txt", "r");
    while (!feof ($f)) {
      $coluna = explode(" ", fgets ($f));
      echo
        "<tr>"
            ."<td>".$coluna[0]."</td>"
            ."<td>".$coluna[1]."</td>"
            ."<td>R$".$coluna[2]."</td>"
       ."</tr>";
    }
    fclose ($f);
  ?>

</table>

</body>
</html>
