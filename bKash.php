<?php
header('Content-Type: image/png');

$number = isset($_GET['number']) ? htmlspecialchars($_GET['number']) : '01986833907';
$transactionId = isset($_GET['transaction']) ? htmlspecialchars($_GET['transaction']) : '730MGQG6GH';
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : '10000';
$total = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : '10000';

$totalWithExtra = $total + 17;

date_default_timezone_set('Asia/Dhaka');
$time = date('h:i A');
$dayMonthYear = date('d/m/y');
$background = imagecreatefromjpeg('ss.jpg');

//$black = imagecolorallocate($background, 0, 0, 0);

$black = imagecolorallocate($background, 90, 90, 90);
$black2 = imagecolorallocate($background,90, 90, 90);

$Antik = __DIR__ . '/roboto.ttf';
$Antik2 = __DIR__ . '/roboto2.ttf';
$fontSize = 50;
$fontSizeBold = 55;
$fontSizeBold2 = 60;
$trim = 47;
$imageWidth = imagesx($background);
$textStyles = [
    'number1' => ['x' => 400, 'y' => 850, 'size' => $fontSizeBold, 'font' => $Antik, 'color' => $black],
    
    'number2' => ['x' => 400, 'y' => 950, 'size' => $fontSizeBold, 'font' => $Antik2, 'color' => $black],
    
    'transactionId' => ['x' => $imageWidth - 384, 'y' => 1430, 'size' => $fontSizeBold2, 'font' => $Antik, 'color' => $black, 'align' => 'right'],
    
    'total' => ['x' => 175, 'y' => 1880, 'size' => $fontSize, 'font' => $Antik2, 'color' => $black],
    
    'totalWithExtra' => ['x' => 170, 'y' => 1768, 'size' => $fontSize, 'font' => $Antik, 'color' => $black2],
    
    'time' => ['x' => 135, 'y' => 1421, 'size' => $fontSize, 'font' => $Antik, 'color' => $black],
    
    'dayMonthYear' => ['x' => 439, 'y' => 1420, 'size' => $fontSize, 'font' => $Antik, 'color' => $black],
    
    'timeeee' => ['x' => 50, 'y' => 109, 'size' => $trim, 'font' => $Antik2, 'color' => $black],
];

$texts = [
    'number1' => $number,
    'number2' => $number,
    'transactionId' => $transactionId,
    'total' => $total.' +17.39',
    'totalWithExtra' => $totalWithExtra,
    'time' => $time,
    'dayMonthYear' => $dayMonthYear,
    'timeeee' => $time
];

foreach ($textStyles as $key => $style) {
    if (isset($texts[$key])) {
        if (isset($style['align']) && $style['align'] == 'right') {
            $bbox = imagettfbbox($style['size'], 0, $style['font'], $texts[$key]);
            $textWidth = abs($bbox[2] - $bbox[0]);
            $x = $style['x'] - $textWidth;
        } else {
            $x = $style['x'];
        }
        imagettftext($background, $style['size'], 0, $x, $style['y'], $style['color'], $style['font'], $texts[$key]);
    }
}
imagepng($background);
imagedestroy($background);
?>
