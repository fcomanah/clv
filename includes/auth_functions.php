<?php
    function auth($link, $email, $senha){
        $senha = md5($senha);

        $query = sprintf("SELECT `nome`,`sobrenome` FROM `administrador` WHERE `email` = '%s' AND `senha` = '%s';",
            mysqli_real_escape_string($link, $email),
            mysqli_real_escape_string($link, $senha));

		    $result=mysqli_query($link, $query);

        if (!$result) {
            $message  = 'Invalid query: ' . mysqli_error($link) . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }

        if (mysqli_num_rows($result) == 1) {
            $status = 'dentro';
            $msg_color ='#0F0';
            $msg = "Login efetuado com sucesso!";
        } else {
            $status = 'fora';
            $msg_color ='#F00';
            $msg = "Email ou senha estão incorretos.";
        }

        mysqli_free_result($link,$result);

        return array ( $status, $msg, $msg_color );
    }
?>
