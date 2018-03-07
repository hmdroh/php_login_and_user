<?php
require_once("functions.php");
// Set the content-type
header('Content-Type: image/png');

// Create the image
$im = @imagecreatetruecolor(60, 30);
// Create some colors
$white = @imagecolorallocate($im, 255, 255, 255);
$grey = @imagecolorallocate($im, 128, 128, 128);
$red = @imagecolorallocate($im, 255, 0, 0);
$black = @imagecolorallocate($im, 0, 0, 0);
@imagefilledrectangle($im, 0, 0, 60, 29, $white);

// The text to draw
$text = randChar();
// Replace path by your own font path
$font = 'OpenSans-Bold.ttf';

// Add some shadow to the text
//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
@imagettftext($im, 12, 5, 5, 20, $red, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()

@imagepng($im);
imagepng($im,"cap.png");
@imagedestroy($im);


?>