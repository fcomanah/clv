<?php
// Iniciar Session PHP 
session_start();
// Se o usuário não estiver logado manda ele para o formulário de login
if ($_SESSION["Login"] != "YES") {
header("Location: auth.html");
}
?>
<html>
<head>
	<meta charset="utf-8" />
<title>Login</title>
</head>
<body>
<h1>Este é um documento de acesso restrito</h1>
<p>Acesso permitido somente para usuários logados.</p>
</body>
</html>
