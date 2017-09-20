<?php

	// ini_set('display_errors', 0);
	// ini_set('display_startup_errors', 0);
	// error_reporting(E_ALL);

	include('assets/simple_html_dom.php');
	include('assets/functions.php');

?><!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">

	<title>Vape search</title>

	<style type="text/css">
		form 			{ margin:50px auto; width:220px; text-align:center; }
		form input[type="text"]			{ width:220px; display:inline-block; text-align:center; }
		form input[type="submit"]		{ width:220px; display:inline-block; text-align:center; }

		table 			{ margin:0 auto; }
		table tr 			{  }
		table tr th 			{ padding:5px; text-align:left; border-bottom: 1px solid black; }
		table tr td 			{ padding:5px; vertical-align:top; border-bottom: 1px solid black; }
		table tr td img 			{ max-width:300px; max-height:200px; }
	</style>
</head>
<body>



		<form method="POST">
			<input name="searchfor" type="text" value="<?= ( isset($_POST['searchfor']) ? $_POST['searchfor'] : null ) ?>">
			<input type="submit" value="ok">
		</form>


<?php
	if( isset($_POST['searchfor']) ){
?>
		<table>
			<tr>
				<th>Link produto</th>
				<th>Nome</th>
				<th>Preço</th>
				<th>Imagem</th>
				<th>Loja</th>
			</tr>
<?php
		$searchTerm = str_replace(' ', '+', $_POST['searchfor']);
		$arrayProdutos = sacaProdutosSearch($searchTerm);
	 	foreach ($arrayProdutos as $produto) {
?>
			<tr>
				<td><a target="_blank" href="<?=$produto['url']?>">abrir</a></td>
				<td><?=$produto['title']?></td>
				<td>€ <?=$produto['price']?></td>
				<td><img src="<?=$produto['img']?>"></td>
				<td><a target="_blank" href="<?=$produto['loja_url']?>"><?=$produto['loja_nome']?></a></td>
			</tr>
<?php
		}
?>
		</table>
<?php
	}
?>




</body>
</html>