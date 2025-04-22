<?php
$code = $_GET['code'] ?? '';
if (!preg_match('/^[a-f0-9]{4}$/', $code)) {
	http_response_code(400);
	exit('Invalid code');
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $code;

// Temp file
$tmp = tempnam(sys_get_temp_dir(), 'qr_') . '.png';

// Use qrencode to generate the image
exec("qrencode -o " . escapeshellarg($tmp) . " " . escapeshellarg($url));

// Output image
if (file_exists($tmp)) {
	header('Content-Type: image/png');
	readfile($tmp);
	unlink($tmp);
} else {
	http_response_code(500);
	echo "QR generation failed.";
}
