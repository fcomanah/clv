<?php
	include("includes/db.php");
	include("includes/carrinho_functions.php");
	include("includes/pagamento_functions.php");

  if($_REQUEST['command']=='verify') {
    $_SESSION['cpf_valido'] =   validaCPF($_POST['cpf']);
    $_SESSION['email']      =   $_POST['email'];
    $_SESSION['name_sname'] =   $_POST['name'].' '.$_POST['sname'];
		$_SESSION['name'] 			=   $_POST['name'];
		$_SESSION['sname'] 			=   $_POST['sname'];
    $_SESSION['cpf']        =   $_POST['cpf'];
    $_SESSION['tel']        =   $_POST['telefone'];

    if(!$_SESSION['cpf_valido']){
      $msg_color ='#F00';
      $msg = "O CPF digitado é incorreto.";
    }
  }else if($_REQUEST['command']=='edit') {
		$_SESSION['cpf_valido'] = false;
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pagamento</title>
	<style type="text/css">
		:invalid {
		  border-color: #e88;
		  -webkit-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
		  -moz-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
		  -o-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
		  -ms-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
		  box-shadow:0 0 5px rgba(255, 0, 0, .8);
		}

		:required {
		  border-color: #88a;
		  -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
		  -moz-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
		  -o-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
		  -ms-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
		  box-shadow: 0 0 5px rgba(0, 0, 255, .5);
		}

		form {
		  width:500px;
		  margin: 50px auto;
		}

		input {
		  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		  border:1px solid #ccc;
		  font-size:20px;
		  width:300px;
		  min-height:30px;
		  display:block;
		  margin-bottom:15px;
		  margin-top:5px;
		  outline: none;

		  -webkit-border-radius:5px;
		  -moz-border-radius:5px;
		  -o-border-radius:5px;
		  -ms-border-radius:5px;
		  border-radius:5px;
		}

		input[type=submit] {
		  background:none;
		  padding:10px;
		}
	</style>
</head>


<body>
<div align="right">
    <a style="text-decoration: none" href="catalogo.php">Catálogo</a>
    <a style="text-decoration: none" href="carrinho.php">Carrinho</a>
    <a style="text-decoration: none" href="pagamento.php">Pagamento</a>
</div>

<?php if( $_SESSION['cpf_valido'] ){ ?>
			<form name="bcash" action="https://www.bcash.com.br/checkout/pay/" method="post">
		  <!-- <form name="bcash" action="lib/post/bcash_action.php" method="post">-->
  			<input type="hidden" name="command" />
		    <input name="redirect" type="hidden" value="true">
					<!-- TODO inserir dados do bcash-->
			    <input name="email_loja" type="hidden" value="manaphys@gmail.com">
			    <input name="url_retorno" type="hidden" value="<?php echo $_SERVER['SERVER_NAME']?>/clv/retorno.php">
			    <input name="url_aviso" type="hidden" value="<?php echo $_SERVER['SERVER_NAME']?>/clv/aviso.php">

			    <input name="id_pedido" type="hidden" value="<?php echo 1100//$_SESSION['chave']?>">
			    <?php  if (!empty($_SESSION['cart']))
			        {
			            $contador = 1;
			            foreach($_SESSION['cart'] as $row)
			            {
			                echo '
			                    <input name="produto_codigo_'.$contador.'" type="hidden" value="'.$row['productid'].'">
			                    <input name="produto_descricao_'.$contador.'" type="hidden" value="'.get_description($link,$row['productid']).'">
			                    <input name="produto_qtde_'.$contador.'" type="hidden" value="'.$row['qty'].'">
			                    <input name="produto_valor_'.$contador.'" type="hidden" value="'.get_price($link,$row['productid']).'" >
			                    <input name="produto_extra_'.$contador.'" type="hidden" value="extra" >
			                ';
			                $contador++;
			            }
			        }
			    ?>
			    <input name="frete" type="hidden" value="<?php echo get_frete()?>">
			    <input name="email" type="hidden" value="<?php echo $_SESSION['email']?>" >
			    <input name="cpf" type="hidden" value="<?php echo $_SESSION['cpf']?>">
			    <input name="nome" type="hidden" value="<?php echo $_SESSION['name_sname']?>">
			    <input name="telefone" type="hidden" value="<?php echo $_SESSION['tel']?>">
			    <input name="cep" type="hidden" value="<?php echo $_SESSION['sCepDestino']?>">


				<div align="center">
			        <h1 align="center">Pagamento</h1>
			        <p>
								<a href="javascript:edit();" title="Clique aqui para editar os dados cadastrados."><?php echo $_SESSION['name_sname']?></a>, o total da compra é </br>
								<h3><?php echo 'R$ ' . number_format(get_order_total($link), 2, '.', ' ');?></h3>
							</p>
			        <table border="0" cellpadding="2px">
			            <tr><td>&nbsp;</td><td><input type="image" src="https://www.bcash.com.br/webroot/img/bt_comprar.gif" value="Pagar" alt="Pagar" border="0" align="absbottom" ></td></tr>
			        </table>
				</div>
			</form>

		<form name="form1" action="pagamento.php" method="POST">
			<input type="hidden" name="command" value="edit" />
		</form>

		<script language="javascript">
			function edit(){
				document.form1.submit();
	    }
		</script>

<?php }else if (isset($_SESSION['cart'])){?>

			<form name="form2" method="POST">
			  <input type="hidden" name="command" value="verify" />
				<div align="center">
			        <h1 align="center">Seus Dados</h1>
			        <div style="color:<?php echo $msg_color?>"><?php echo $msg?></div>
			        <table border="0" cellpadding="2px">
			            <tr><td>Nome:</td><td><input type="text" name="name" required value="<?php echo $_SESSION['name']?>"/></td></tr>
			            <tr><td>Sobrenome:</td><td><input type="text" name="sname" required value="<?php echo $_SESSION['sname']?>"/></td></tr>
			            <tr><td>Email:</td><td><input type="email" name="email" required value="<?php echo $_SESSION['email']?>"/></td></tr>
			            <tr><td>CPF:</td><td><input type="text" name="cpf" maxlength="14" placeholder="888.888.888-88" required
			                    pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2})|(\d{11})$"
			                    onkeypress="return formatar('###.###.###-##', this, event)"
			                    oninput="validar(this)"
			                    value="<?php echo $_SESSION['cpf']?>" /></td></tr>
			            <tr><td>Telefone:</td><td><input name="telefone" type="tel" maxlength="13" placeholder="11-88888-8888" required
			                    pattern="^(\d{2}\-\d{5}\-\d{4})|(\d{11})$"
			                    onkeypress="return formatar('##-#####-####', this, event)"
			                    value="<?php echo $_SESSION['tel']?>"/></td></tr>
			            <tr><td>&nbsp;</td><td><input type="submit" value="Conferir Dados" /></td></tr>
			        </table>
				</div>
			</form>

			<script language="javascript">
			    function validar(input) {
			        if (!validarCPF(input.value)) {
			            if(input.value=='') {
			                input.setCustomValidity('Preencha este campo.');
			            } else {
			                input.setCustomValidity(input.value + ' é um CPF incorreto.');
			            }
			        } else {
			            input.setCustomValidity('');
			        }
			    }

			    function validarCPF(cpf) {
			        cpf = cpf.replace(/[^\d]+/g,'');
			        if(cpf == '') return false;
			        // Elimina CPFs invalidos conhecidos
			        if (cpf.length != 11 ||
			            cpf == "00000000000" ||
			            cpf == "11111111111" ||
			            cpf == "22222222222" ||
			            cpf == "33333333333" ||
			            cpf == "44444444444" ||
			            cpf == "55555555555" ||
			            cpf == "66666666666" ||
			            cpf == "77777777777" ||
			            cpf == "88888888888" ||
			            cpf == "99999999999")
			            return false;
			        // Valida 1o digito
			        add = 0;
			        for (i=0; i < 9; i ++)
			            add += parseInt(cpf.charAt(i)) * (10 - i);
			        rev = 11 - (add % 11);
			        if (rev == 10 || rev == 11)
			            rev = 0;
			        if (rev != parseInt(cpf.charAt(9)))
			            return false;
			        // Valida 2o digito
			        add = 0;
			        for (i = 0; i < 10; i ++)
			            add += parseInt(cpf.charAt(i)) * (11 - i);
			        rev = 11 - (add % 11);
			        if (rev == 10 || rev == 11)
			            rev = 0;
			        if (rev != parseInt(cpf.charAt(10)))
			            return false;
			        return true;
			    }

			    function formatar(mascara, documento, evt){
			      var i = documento.value.length;
			      var saida = mascara.substring(0,1);
			      var texto = mascara.substring(i)
			      if (texto.substring(0,1) != saida){
			            documento.value += texto.substring(0,1);
			      }
			      return isNumber(evt);
			    }

			    function isNumber(evt) {
			        evt = (evt) ? evt : window.event;
			        var charCode = (evt.which) ? evt.which : evt.keyCode;
			        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			            return false;
			        }
			        return true;
			    }

			</script>

<?php } else { header("location:catalogo.php"); }?>

</body>
</html>
