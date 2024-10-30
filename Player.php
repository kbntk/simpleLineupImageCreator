<?php
require_once 'ColorAllocator.php';

class Player
{

    public $image;

    public $imagePath;

    public $position;

    public $number;

    public $numberWhite;

    public $name;

    public $tshirtColor;

    public function __construct($imagePath, $position, $number, $name, $tshirtColor = "red")
    {
        $this->imagePath = $imagePath;
        $this->image = imagecreatefrompng($imagePath);
        $this->position = $position;
        $this->number = $number;
        $this->name = $name;
        $this->numberWhite = in_array($tshirtColor, [
            'red',
            'blue',
            'green',
            'brown',
            'black'
        ]) ? true : false;
        $this->tshirtColor = $tshirtColor;
        $this->changeColor('red', $this->tshirtColor);
        $this->addText();
    }

    public function __destruct()
    {
        if ($this->image) {
            imagedestroy($this->image);
        }
    }

    public function addText()
    {
        // Set the text color
        $white = imagecolorallocate($this->image, 250, 250, 250);
        $black = imagecolorallocate($this->image, 0, 0, 0);

        // Set the path to the font file
        $fontPath = '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf';
        // Add text to the image
        $nameTextBox = imagettfbbox(18, 0, $fontPath, $this->name);
        $textWidth = $nameTextBox[2] - $nameTextBox[0]; // Calculate text width
        $textHeight = $nameTextBox[1] - $nameTextBox[7]; // Calculate text height
        $nameXCenter = 170;
        $nameYCenter = 276;
        $nameX = round($nameXCenter - ($textWidth / 2));
        $nameY = round($nameYCenter + ($textHeight / 2));
        $numberYCenter = 100;
        $numberTextBox = imagettfbbox(60, 0, $fontPath, $this->number);
        $numberWidth = $numberTextBox[2] - $numberTextBox[0]; // Calculate text width
        $numberHeight = $numberTextBox[1] - $numberTextBox[7]; // Calculate text height
        $numberX = round($nameXCenter - ($numberWidth / 2));
        $numberY = round($numberYCenter + ($numberHeight / 2));
        if ($this->tshirtColor != 'red') {
            $this->changeColor('red', $this->tshirtColor);
        }
        imagettftext($this->image, 18, 0, $nameX, $nameY, $white, $fontPath, $this->name);
        if ($this->numberWhite) {
            imagettftext($this->image, 60, 0, $numberX, $numberY, $white, $fontPath, $this->number);
        } else {
            imagettftext($this->image, 60, 0, $numberX, $numberY, $black, $fontPath, $this->number);
        }
    }

    public function render()
    {
        header("Content-Type: image/jpeg");

        return imagejpeg($this->image);
    }

    public function saveAs($filepath)
    {
        // $this->addText();
        return imagejpeg($this->image, $filepath);
    }

    public function changeColor($oldColor, $newColor)
    {
        $image = imagecreatetruecolor(2, 2);
        $oldColorAllocate = ColorAllocator::getColorByName($image, $oldColor);
        $newColorAllocate = ColorAllocator::getColorByName($image, $newColor);
        // Define the colors
        // $oldColorFinal = imagecolorallocate($image, 255, 0, 0); // Color to change (e.g., red)
        // $newColorFinal = imagecolorallocate($image, 0, 0, 255); // New color (e.g., blue)

        // Get image dimensions
        $width = imagesx($this->image);
        $height = imagesy($this->image);

        // Loop through each pixel
        for ($x = 0; $x < $width; $x ++) {
            for ($y = 0; $y < $height; $y ++) {
                // Get the color index of the current pixel
                $currentColor = imagecolorat($this->image, $x, $y);

                // If the current color matches the old color, change it to the new color
                if ($currentColor === $oldColorAllocate) {
                    imagesetpixel($this->image, $x, $y, $newColorAllocate);
                }
            }
        }
    }
}
?>