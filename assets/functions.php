<?php


function sacaProdutosSearch($searchTerm){



	$baseURL = "http://www.vaporizarte.com";
	$baseURL2 = $baseURL . "/epages/960509405.sf/pt_PT";
	$html = file_get_html($baseURL2 . "/?ObjectID=14979695&ViewAction=FacetedSearchProducts&SearchString=" . $searchTerm);

	foreach($html->find('table.ProductListImageBox > tbody > tr > td > .InfoArea') as $article) {
		$item['title']			= $article->find('a', 1)->plaintext;
		$item['url'] 			= $baseURL2 . $article->find('.ImageArea a', 0)->href;
		$item['img'] 			= $baseURL . $article->find('.ImageArea a img', 0)->src;
		$price 					= $article->find('.price-value', 0)->plaintext;

		if($price==''){
			$price = 'Preço variável';
		}else{
			$price 	= preg_replace("/[^0-9,.]/", '', $price);
		}

		$item['price'] 			= str_replace(',', '.', $price);
		$item['loja_nome'] 		= 'Vaporizarte';
		$item['loja_url'] 		= $baseURL;

		$articles[] = $item;
	}



	$baseURL = "https://2smok.com";
	$html = file_get_html($baseURL . "/catalogsearch/result/index/?limit=all&q=" . $searchTerm);

	foreach($html->find('.products-grid .item') as $article) {
		$item['title']			= $article->find('.product-name a', 0)->plaintext;
		$item['url'] 			= $article->find('a', 0)->href;
		$item['img'] 			= $article->find('img', 0)->src;

		$price 					= preg_replace("/[^0-9,.]/", '', $article->find('.price', 0)->plaintext);
		$item['price'] 			= str_replace(',', '.', $price);

		$item['loja_nome'] 		= '2smok';
		$item['loja_url'] 		= $baseURL;

		$articles[] = $item;
	}



	usort($articles, function($a, $b) {
	    return $a['price'] <=> $b['price'];
	});



	return $articles;
}


