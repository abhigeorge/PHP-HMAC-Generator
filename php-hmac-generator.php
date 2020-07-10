<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP HMAC Generator Online</title>
  </head>
<body class="bg-light">

<?php
	function strToHex($string)
	{
		$hex='';
		for ($i=0; $i < strlen($string); $i++)
		{
		    $hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}

	function hexToStr($hex)
	{
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2)
	    {
	    	if ( $hex[$i] == ' ') continue;
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}


	if(isset($_POST["inputString"])) {

		if ($_POST['datatype']=="Text") {
			$useHex = false;
		} else {
			$useHex = true;
		}

		if ( $useHex ) {
			$text = hexToStr($_POST['inputString']);
			$key = hexToStr($_POST['secretKey']);
		} else {
		    $text = $_POST['inputString'];
		    $key  = $_POST['secretKey'];
		}

	    $algo = $_POST['algorithm'];
		if ( $algo == "MD5") {
				$digest = md5($text, false);
				$hmac_digest = hash_hmac("md5", $text, $key, false);
		}
		else if ( $algo == "SHA1") {
				$digest = sha1($text, false);
				$hmac_digest = hash_hmac("sha1", $text, $key, false);
		}
		else if ( $algo == "SHA224") {
				$digest = openssl_digest($text, "sha224", false);
				$hmac_digest = hash_hmac("sha224", $text, $key, false);
		}
		else if ( $algo == "SHA256") {
				$digest = openssl_digest($text, "sha256", false);
				$hmac_digest = hash_hmac("sha256", $text, $key, false);
		}
    }
?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="./PHP-HMAC-Generator.png" alt="" width="125" height="125">
    <h2>PHP HMAC Generator</h2>
    <p class="lead">Computes a Hash-based message authentication code (HMAC) using a secret key. A HMAC is a small set of data that helps authenticate the nature of message; it protects the integrity and the authenticity of the message. </p>
  </div>

<div class="container">


<form action="" method="post" name="form1">
<div class="form-group">
<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" id="datatype" name="datatype">
	<option  value="Text">Text </option>
	<option  value="Hex">Hex</option>
</select>
</div>
<div class="form-group">
<div class="title first"><span class="option">Message</span></div>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="2" rows="" cols="80" id="inputString" name="inputString"></textarea>
			</div>
			<div class="form-group">
			<div class="title"><span class="option">Secret Key</span></div>
			<input type="text" class="form-control" id="exampleFormControlTextarea1" name="secretKey" style="width:100%;" value=""/>
			</div>
			<div class="form-group">
		<div class="title"><span class="option">Select a Message Digest Algorithm</span></div>
						<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" id="algorithm" name="algorithm">
							<option  value="SHA1">SHA1</option>
							<option  value="SHA224">SHA224</option>
							<option  value="SHA256">SHA256</option>
							<option  value="MD5">MD5</option>
							<option  value="DES">DES</option>
						</select>
						</div>
						<div class="buttons">
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="Create Hash">
						</div>

</form>
</div>
<br>
<div class="container">
    <div class="card" style="width: 100%">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Algorithm: <strong><?php echo $algo; ?></strong></li>
    <li class="list-group-item">Message : <strong><?php echo $text; ?></strong></li>
    <li class="list-group-item"><?php
	    echo "Message strToHex: ".strToHex($text)."<br/>";
?></li>
    <li class="list-group-item">Key : <strong><?php echo $key; ?></strong></li>
    <li class="list-group-item"><?php
	    echo "key strToHex: ".strToHex($key)."<br/>";
?></li>
    <li class="list-group-item">no-hmac: <strong><?php echo $digest; ?></strong></li>
    <li class="list-group-item">HMAC: <strong><?php echo $hmac_digest; ?></strong></li>
  </ul>
</div>
</div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
