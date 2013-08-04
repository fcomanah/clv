<?
 
require_once('Frete.class.php');
 
$frete = new Frete();
 
$frete->setCep_origem('69990000'); //oiapoqueAP 68980970, uiramutãRR 69358000, manciolimaAC 69990000
$frete->setCep_destino('58010000'); //chuíRS 96255970 joaopessoaPB 58010000
/*
 * TIPO DE SERVIÇO
 * VALORES VÁLIDOS:
 *  pac
 *  sedex
 *  sedex 10
 *  sedex a cobrar
 */
$frete->defineServico('pac');
 
/*PESO EM KG (EX: SE FOR 500gr INFORME 0.5)*/
$frete->setPeso('1');
$frete->setAltura('2');
$frete->setLargura('11');
$frete->setComprimento('16');
$frete->setValor('0.00');
 
$retorno = $frete->calcular();
 
if($frete->getErro()){
    die("Ocorreu um erro: " . $frete->getErro());
}
 
echo "Informacoes do frete com origem ". $frete->getCep_origem() ." e destino ". $frete->getCep_destino() ." <br />";
echo "Valor do frete: $retorno->Valor reais <br />";
echo "Prazo para entrega: $retorno->PrazoEntrega dias <br />";
echo "Entrega domiciliar? $retorno->EntregaDomiciliar <br />";
echo "Entrega sabado? $retorno->EntregaSabado";

?>