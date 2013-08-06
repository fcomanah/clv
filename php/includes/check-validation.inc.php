<?

//funcao obtida em http://codigofonte.uol.com.br/codigos/validacao-de-cpf-com-php
//substituido o suso de ereg_replace por preg_replace 
function validaCPF($cpf)
{	// Verifica se o número digitado contém todos os digitos
    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
   if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
	  return false;
   }
	else
	{   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
 
            $d = ((10 * $d) % 11) % 10;
 
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}

	// Check for Magic Quotes:
	if (get_magic_quotes_gpc()) {
		$_POST['nome'] = stripslashes($_POST['nome']);
		// Repeat for other variables that could be affected.
	}

	// Check for a name:
	if (preg_match ('/^[A-Záâãéêíóôúç\'.-]{2,20}[ ]{1,1}[A-Záâãéêíóôúç \'.-]{2,40}$/i', $_POST['nome'])) {
		$fn = addslashes($_POST['nome']);
	} else {
		$shipping_errors['nome'] = 'Gentileza fornecer o nome!';
	}
	
	// Check for a cpf:
	if (validaCPF($_POST['cpf'])) {
		$cpf = $_POST['cpf'];
	} else {
		$shipping_errors['cpf'] = 'Gentileza fornecer o cpf!';
	}

	// Check for a street address:
	if (preg_match ('/^[A-Z0-9 \',.#-]{2,80}$/i', $_POST['endereco'])) {
		$a1  = addslashes($_POST['endereco']);
	} else {
		$shipping_errors['endereco'] = 'Gentileza fornecer o endereço!';
	}
	
	// Check for a second street address:
	if (empty($_POST['complemento'])) {
		$a2 = NULL;
	} elseif (preg_match ('/^[A-Z0-9 \',.#-]{2,80}$/i', $_POST['complemento'])) {
		$a2 = addslashes($_POST['complemento']);
	} else {
		$shipping_errors['complemento'] = 'Gentileza fornecer o complemento!';
	}
	
	// Check for a bairro:
	if (preg_match ('/^[A-Záâãéêíóôúç \'.-]{2,60}$/i', $_POST['bairro'])) {
		$c = addslashes($_POST['bairro']);
	} else {
		$shipping_errors['bairro'] = 'Gentileza fornecer o bairro!';
	}
	
	// Check for a cidade:
	if (preg_match ('/^[A-Záâãéêíóôúç \'.-]{2,60}$/i', $_POST['cidade'])) {
		$c = addslashes($_POST['cidade']);
	} else {
		$shipping_errors['cidade'] = 'Gentileza fornecer a cidade!';
	}
	
	// Check for a estado:
	if (preg_match ('/^[A-Z]{2}$/', $_POST['estado'])) {
		$s = $_POST['estado'];
	} else {
		$shipping_errors['estado'] = 'Gentileza fornecer o estado!';
	}
	
	// Check for a cep code: 
	if (preg_match('/^[0-9]{5}([- ]?[0-9]{3})?$/', $_POST['cep'])) {
		$cep = $_POST['cep'];
	} else {
		$shipping_errors['cep'] = 'Gentileza fornecer o CEP!';
	}
	
	// Check for a telefone number:
	// Strip out spaces, hyphens, and parentheses:
	$telefone = str_replace(array(' ', '-', '(', ')'), '', $_POST['telefone']);
	if (preg_match ('/^[0-9]{10}$/', $telefone)) {
		$p  = $telefone;
	} else {
		$shipping_errors['telefone'] = 'Gentileza fornecer o telefone!';
	}
	
	// Check for an email address:
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$e = $_POST['email'];
		$_SESSION['email'] = $_POST['email'];
	} else {
		$shipping_errors['email'] = 'Gentileza fornecer o email!';
	}