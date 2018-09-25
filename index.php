<?php
	
	/*
	 * Get api response from beta.0xthemes.com
	 * Need to send item_id to them. Here we using item_id from get method
	 * Must need "?item_id=123" parameter from url 
	 * if you don't pass item_id for this example it'll show blank page
	 */

	$preview_stat = 1;
	if( isset( $_GET["item_id"] ) && $_GET["item_id"] != '' ){
		$json_0xthemes = file_get_contents( "http://beta.0xthemes.com/api/get_demo_url?item_id=". htmlspecialchars( $_GET["item_id"] ) );
		if( $json_0xthemes ){
			$preview_details = json_decode( $json_0xthemes, true );
			if( empty( $preview_details ) ){
				$preview_stat = 0;
			}
		}else{
			$preview_stat = 0;
		}
	}else{
		$preview_stat = 0;
	}
	
	// Check preview_stat 
	if( $preview_stat ){
		$site_title = $preview_details[0]["node"]["title"];
		$market_theme_url = 'http://beta.0xthemes.com/' . $preview_details[0]["node"]["url"];
		$demo_url = $preview_details[0]["node"]["demo_url"];
		$buy_txt = "Buy Now";
		$remove_txt = "Remove Frame";
	}else{
		exit;
	}
?>

<!doctype html>
<html lang="zxx">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $site_title; ?></title>
	
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body class="full-screen-preview">
	
	<!-- Preview Header Start -->
	<div class="preview-header">
		<div class="market-logo">
			<img src="assets/images/market-logo.png" class="img-fluid" alt="0xthemes" />
		</div>
		<div class="header-right-part">
			<div class="theme-buynow-btn">
				<a href="<?php echo $market_theme_url; ?>" class="btn theme-btn" target="_self"><?php echo $buy_txt; ?></a>
			</div>
			<div class="remove-frame-pack">
				<a href="<?php echo $demo_url; ?>" class="btn remove-frame" target="_self"><?php echo $remove_txt; ?> <span class="close remove-frame-icon"></span></a>
			</div>
		</div>
	</div>
	<!-- Preview Header End -->
	
	<!-- Preview Iframe Start -->
	<iframe class="full-screen-preview-frame" src="<?php echo $demo_url; ?>"></iframe>
	<!-- Preview Iframe Start -->	
	
	<!-- jQuery Library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Theme Custom Js -->
	<script src="assets/js/custom.js"></script>
	
</body>
</html>
