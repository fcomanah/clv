<?php

  include 'cart_begin.html';

  echo '
    <section id="cart_items">
  		<div class="container">
  			<div class="breadcrumbs">
  				<ol class="breadcrumb">
  				  <li><a href="#">Início</a></li>
  				  <li class="active">Carrinho</li>
  				</ol>
  			</div>
  			<div class="table-responsive cart_info">
  				<table class="table table-condensed">
  					<thead>
  						<tr class="cart_menu">
  							<td class="image">Item</td>
  							<td class="description"></td>
  							<td class="price">Preço</td>
  							<td class="quantity">Quantidade</td>
  							<td class="total">Total</td>
  							<td></td>
  						</tr>
  					</thead>
  					<tbody>
  ';

  $f = fopen("carrinho.txt", "r");

  while(!feof($f)) {
    $campos=explode(" ",fgets($f));
    $item=$campos[0];
    $preço=$campos[1];
    $quantidade=$campos[2];



    echo '
    						 <tr>
    							<td class="cart_product">
    								<a href=""><img src="images/cart/one.png" alt=""></a>
    							</td>
    							<td class="cart_description">
    								<h4><a href="">'.$item.'</a></h4>
    								<p>Web ID: 1089772</p>
    							</td>
    							<td class="cart_price">
    								<p>R$'.$preço.'</p>
    							</td>
    							<td class="cart_quantity">
    								<div class="cart_quantity_button">
    									<a class="cart_quantity_up" href=""> + </a>
    									<input class="cart_quantity_input" type="text" name="quantity" value="'.$quantidade.'" autocomplete="off" size="2">
    									<a class="cart_quantity_down" href=""> - </a>
    								</div>
    							</td>
    							<td class="cart_total">
    								<p class="cart_total_price">R$'.
                    number_format($preço*$quantidade, 2, '.', '')
                    .'</p>
    							</td>
    							<td class="cart_delete">
    								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
    							</td>
    						</tr>
    ';
  }
  fclose($f);
  echo '
  					</tbody>
  				</table>
  			</div>
  		</div>
  	</section> <!--/#cart_items-->
  ';

  include 'cart_end.html';
?>
