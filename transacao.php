<?php
	include("includes/db.php");
	include("includes/auth_functions.php");
	include("includes/transacao_functions.php");

	if($_REQUEST['command']=='login'){

		$email=$_REQUEST['email'];
        $senha=$_REQUEST['senha'];
        list ( $_SESSION['status'], $msg, $msg_color ) = auth($link,$email, $senha);

	}else if($_REQUEST['command']=='update'){
        $transaction=array();
        $transaction[0]=$_REQUEST['tid'];
        $transaction[3]=$_REQUEST['tstat'];
        update_transaction($link,$transaction);

	}else if($_REQUEST['command']=='edit'){
        $pedit = $_REQUEST['tid'];

	}else if($_REQUEST['command']=='logout'){

        $_SESSION['status'] = 'fora';
        $msg_color ='#0F0';
        $msg = "Logout feito com sucesso.";
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Transação</title>
<script language="javascript">
	function validate(){
		var f=document.form1;
		if(f.email.value==''){
			alert('O email é obrigatório.');
			f.email.focus();
			return false;
		}
		if(f.senha.value==''){
			alert('A senha é obrigatória.');
			f.senha.focus();
			return false;
		}
		f.command.value='login';
		f.submit();
	}
	function update(tid){
		var f=document.form1;
        f.tid.value=tid;
		if(f.tstat.value==''){
			alert('O status é obrigatório.');
			f.tstat.focus();
			return false;
		}
		f.command.value='update';
		f.submit();
    }
	function edit(tid){
		document.form1.tid.value=tid;
		document.form1.command.value='edit';
		document.form1.submit();
	}
</script>
</head>

<body>

<?php if($_SESSION['status'] == 'dentro'){?>
				<div align="right">
					  <a href="administrador.php"><input type="submit" value="Administrador" /></td></a>
						<a href="produto.php"><input type="submit" value="Produto" /></td></a>
						<a href="status.php"><input type="submit" value="Status" /></td></a>
				</div>
        <form name="form2" method="POST">
            <input type="hidden" name="command" value="logout" />
            <div align="right">
                <table border="0" cellpadding="2px">
                    <tr><td>&nbsp;</td><td><input type="submit" value="Sair" /></td></tr>
                </table>
            </div>
        </form>

<form name="form1" method="post">
<input type="hidden" name="command" />
<input type="hidden" name="tid" />
    <div style="margin:0px auto; width:800px;" >
    <div style="padding-bottom:10px">
    	<h1 align="center">Transação</h1>
        <div style="color:<?php echo $msg_color?>"><?php echo $msg?></div>
    </div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
    	<?php
            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold">
                    <td>#</td>
                    <td># bcash</td>
                    <td>Valor</td>
                    <td>Status</td>
                    <td>Criação</td>
                    <td>Modificação</td>
                    <td>Opções</td></tr>';

            $transactions = get_all_transactions($link);
            $status = get_all_status($link);

			if( count($transactions) > 0 ){

				foreach ($transactions as $transaction){
					$tid   =$transaction[0];
					$tidbcash =$transaction[1];
					$tvalor =$transaction[2];
                    $tstat =$transaction[3];
                    $tcria =$transaction[4];
                    $tmodi =$transaction[5];

                    if ( $tid == $pedit) {
			?>
            		<tr bgcolor="#FFFFFF">
                        <td><?php echo $tid?></td>
                        <td><?php echo $tidbcash?></td>
                        <td><?php echo $tvalor?></td>
                        <td>
                            <select name="tstat">
                            <?php
                                foreach($status as $stat){
                                    echo '<option VALUE="'.$stat[0].'"';
                                    if ($stat[1] == $tstat) echo ' selected="selected"';
                                    echo '>'.$stat[1].'</option>';
                                }
                            ?>
                            </select>
                        </td>
                        <td><?php echo $tcria?></td>
                        <td><?php echo $tmodi?></td>
                        <td><a href="javascript:update(<?php echo $tid?>)">Atualizar</a></td>
                </tr>
            <?php      } else { ?>
            		<tr bgcolor="#FFFFFF">
                        <td><?php echo $tid?></td>
                        <td><a href="andamento.php?command=read&tidbcash=<?php echo $tidbcash?>" target="_blank""><?php echo $tidbcash?></a></td>
                        <td><?php echo number_format($tvalor, 2, '.', ' ')?></td>
                        <td><?php echo $tstat?></td>
                        <td><?php echo $tcria?></td>
                        <td><?php echo $tmodi?></td>
                        <td><a href="javascript:edit(<?php echo $tid?>)">Editar</a></td>
                    </tr>
    <?php             }
				}
            }
			else{
				echo '<tr bgColor=\'#FFFFFF\'><td colspan="6" align="left">Sua Lista de Transações está vazia!</td>';
			}
		?>
        </table>
    </div>
</form>

<?php }else{?>
        <form name="form1" onsubmit="return validate()" method="POST">
            <input type="hidden" name="command" />
            <div align="center">
                <h1 align="center">Login</h1>
                <div style="color:<?php echo $msg_color?>"><?php echo $msg?></div>
                <table border="0" cellpadding="2px">
                    <tr><td>Email:</td><td><input type="text" name="email" value="<?php echo $email?>" /></td></tr>
                    <tr><td>Senha:</td><td><input type="password" name="senha" /></td></tr>
                    <tr><td>&nbsp;</td><td><input type="submit" value="Entrar" /></td></tr>
                </table>
            </div>
        </form>
<?php }?>

</body>
</html>
