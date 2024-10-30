<?php
class ColorAllocator
{
    // Static array of color definitions
    private static $colors = [
        'red' => [255, 0, 20],
        'blue' => [0, 0, 255],
        'green' => [0, 255, 0],
        'white' => [255, 255, 255],
        'brown' => [165, 42, 42],
        'yellow' => [255, 255, 0],
        'black' => [0, 0, 0]
    ];
    
    // Static method to get color by name
    public static function getColorByName($image, $colorName)
    {
        if (isset(self::$colors[$colorName])) {
            $rgb = self::$colors[$colorName];
            return imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
        } else {
            throw new Exception("Color '$colorName' not defined.");
        }
    }
}
