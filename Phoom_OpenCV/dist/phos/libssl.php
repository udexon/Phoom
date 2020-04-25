<?php


function fgl_si() // i-th element of stack (from bottom, as array)
{
    global $S;
    $S[] = $S[ array_pop($S) ]; 
}


function fgl_ssid()
{
    global $S;
    $S[] = session_id( array_pop($S) ); 
}


function fgl_sid()
{
    global $S;
    $S[] = session_id(); 
}


function fgl_srid()
{
    global $S;
    $S[] = session_regenerate_id(); 
}


function fgl_sstart()
{
    global $S;
    $S[] =  session_start();
}

function fgl_sstat()
{
    global $S;
    $S[] =  session_status();

}

// 2020-04-19 store key pair as session variables?

$KPS = array( 'init_at' => date("Y-m-d H:i:s")." ".microtime() );

function fgl_init()
{
    global $S, $KPS;
    $S[] = $KPS[ 'init_at' ];
}

function fgl_impvk() // import pvk
{
    global $S, $KPS;
    openssl_pkey_get_private( array_pop($S) ); 
}

function fgl_dcr() // decrypt, use $KPS['pvk'] directly
{
    global $S, $KPS;
    // openssl_private_decrypt( array_pop($S), $decrypted, $KPS['pvk'] );

// $private = file_get_contents( "o_pvk_2" );

$field = array_pop( $S );
$private = $KPS['pvk'];

if (!$privateKey = openssl_pkey_get_private($private)) die('Loading Private Key failed');
	
	// Decrypt text
	$decrypted_text = "";
	
	if (!openssl_private_decrypt(base64_decode($field), $decrypted_text, $privateKey)) die('Failed to decrypt data');

$S[] = $decrypted_text;

}


function fgl_kps() // push $KPS to stack
{
    global $S, $KPS;
    $S[] = $KPS;
}

function fgl_pbk() // push $KPS['pbk'] to stack
{
    global $S, $KPS;
    $S[] = $KPS['pbk'];
}

function fgl_pvk() // push $KPS['pvk'] to stack
{
    global $S, $KPS;
    $S[] = $KPS['pvk'];
}


function fgl_putkps() // put $KPS to $_SESSION
{
    global $S, $KPS;
    $_SESSION['KPS'] = $KPS;
}

function fgl_getkps() // get $KPS from $_SESSION
{
    global $S, $KPS;
    $KPS = $_SESSION['KPS'];
}

function fgl_ossl()
{
    global $S, $KPS;
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
   
// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

$data = 'plaintext data goes here';

// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, $privKey);

    $KPS['pbk'] = $pubKey;
    $KPS['pvk'] = $privKey;

// echo $decrypted;
$S[] = $pubKey;
}
