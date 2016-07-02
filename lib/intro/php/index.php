<html>
  <head>
    <title>Minha Primeira página PHP</title>
  </head>
    <body>
      <?php
        $frutas[0] = "maça";
        $frutas[1] = "pera";
        $frutas[2] = "uva";
        $frutas[3] = "banana";
        $frutas[4] = "cereja";
        $frutas[5] = "limão";        

          echo "as frutas favoritas são ";
          foreach ($frutas as $f) {
            echo $f . " ";
          }
      ?>
    </Body>
</html>
