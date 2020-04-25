<?php

session_start();
print_r($_SESSION);

echo "<br>hello<br>". session_id(). "<br>";

$b=333;

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

echo $decrypted;

?>

<script type="text/javascript">
a=999
PBK= <?=json_encode($pubKey);?>
</script>
<script type="text/javascript" src="pdo/jsencrypt.min.js"></script>
<script type="text/javascript" src="pdo/fgl.js"></script>
