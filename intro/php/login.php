<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
    </head>
    <body>
    <?php
        // Verifica se usuário e senha conferem
        if ($_POST["username"] == "clv" && $_POST["password"] == "clv") {
            // Se usuário e senha conferir definimos session para YES
            session_start();
            $_SESSION["Login"] = "YES";
            echo "<h1>Você está logado</h1>";
            echo "<p><a href='restricted.php'>Link para o página restrita</a><p/>";
        }
        else {
          // Se usuário e senha conferir definimos session para NO
          session_start();
          $_SESSION["Login"] = "NO";
          echo "<h1>Você NÃO está logado</h1>";
        }
    ?>
    </body>
</html>
