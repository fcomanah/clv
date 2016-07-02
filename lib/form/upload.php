<?php
  $strheading = "<h1>Olá " . $_POST["username"] . "</h1>";
  switch ($_POST["favoritecolor"]) {
    case "r":
      $strbackgroundcolor = "rgb(255,0,0)";
      break;
    case "g":
      $strbackgroundcolor = "rgb(255,255,0)";
      break;
    case "y":
      $strbackgroundcolor = "rgb(0,255,0)";
      break;
    case "b":
      $strbackgroundcolor = "rgb(0,0,255)";
      break;
    case "c":
        $strbackgroundcolor = "rgb(128,128,128)";
        break;
    default:
      $strbackgroundcolor = "rgb(255,255,255)";
      break;
  }
?>
<html>
  <head>
    <title>Formulário</title>
  </head>
  <body style="background: <?php echo $strbackgroundcolor; ?>;">
    <?php echo $strheading; ?>
  </body>
</html>
