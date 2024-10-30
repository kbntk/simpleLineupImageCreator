<?php
require_once './Player.php';

class Field
{

    public $positions;

    public $field;

    public function __construct($imagePath, $lineupSetting)
    {
        if ($lineupSetting === '442') {
            $this->positions['GK'] = [
                "x" => 653 - (350 / 2),
                "y" => 1260 - 250
            ];
            $this->positions[2] = [
                "x" => $this->positions['GK']['x'] - 480,
                "y" => $this->positions['GK']['y'] - 340
            ];
            $this->positions[3] = [
                "x" => $this->positions['GK']['x'] - 240,
                "y" => $this->positions['GK']['y'] - 290
            ];
            $this->positions[4] = [
                "x" => $this->positions['GK']['x'] + 240,
                "y" => $this->positions['GK']['y'] - 290
            ];
            $this->positions[5] = [
                "x" => $this->positions['GK']['x'] + 480,
                "y" => $this->positions['GK']['y'] - 340
            ];
        }
        elseif ($lineupSetting === '352') {
            $this->positions['GK'] = [
                "x" => 653 - (350 / 2),
                "y" => 1260 - 250
            ];
            // defenders
            $this->positions[2] = [
                "x" => $this->positions['GK']['x'] - 360,
                "y" => $this->positions['GK']['y'] - 340
            ];
            $this->positions[3] = [
                "x" => $this->positions['GK']['x'],
                "y" => $this->positions['GK']['y'] - 310
            ];
            $this->positions[4] = [
                "x" => $this->positions['GK']['x'] + 360,
                "y" => $this->positions['GK']['y'] - 340
            ];
            // midfielders
            $this->positions[5] = [
                "x" => $this->positions['GK']['x'] - 500,
                "y" => $this->positions['GK']['y'] - 680
            ];
            $this->positions[6] = [
                "x" => $this->positions['GK']['x'] - 250,
                "y" => $this->positions['GK']['y'] - 660
            ];
            $this->positions[7] = [
                "x" => $this->positions['GK']['x'],
                "y" => $this->positions['GK']['y'] - 640
            ];
            $this->positions[8] = [
                "x" => $this->positions['GK']['x'] + 250,
                "y" => $this->positions['GK']['y'] - 660
            ];
            $this->positions[9] = [
                "x" => $this->positions['GK']['x'] + 500,
                "y" => $this->positions['GK']['y'] - 680
            ];
            // strikers
            $this->positions[10] = [
                "x" => $this->positions['GK']['x'] - 150,
                "y" => $this->positions['GK']['y'] - 980
            ];
            $this->positions[11] = [
                "x" => $this->positions['GK']['x'] + 150,
                "y" => $this->positions['GK']['y'] - 980
            ];
        }
        $this->field = imagecreatefromjpeg($imagePath);
    }

    public function addPlayer(Player $player)
    {
        $pos_x = $this->positions[$player->position]['x'];
        $pos_y = $this->positions[$player->position]['y'];
        imagecopy($this->field, $player->image, $pos_x, $pos_y, 0, 0, 350, 360);
    }

    public function saveAs($filepath)
    {
        // $this->addText();
        return imagejpeg($this->field, $filepath);
    }
}
?>