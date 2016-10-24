<?php
require __DIR__ . '/vendor/autoload.php';
use TkS\QRcode;
use TkS\Generators\GoogleChartsRenderer;

$qrCode = new QRcode('test', 60, 60);
$renderer = new GoogleChartsRenderer();
$qrCode->setRenderer($renderer);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<img src="<?= $qrCode->generate();?>">
<img src="<?= $renderer->buildUrl();?>">
</body>
</html>