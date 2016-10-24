# TkS
QR code render function: an object-oriented QR code renderer where the renderer logic
can be switched/injected.
Default implementation under
https://developers.google.com/chart/infographics/docs/qr_codes.
The API looks like:
```
use TkS\QrCode,
use TkS\Generators\GoogleChartsRenderer;
$qrCode = new QrCode('Text', 50, 50); // text, width, height
$qrCode->setRenderer(new GoogleChartsRenderer());
$qrCodeData = $qrCode->generate(); // returns the image data
```

