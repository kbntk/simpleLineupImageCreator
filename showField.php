<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './Player.php';
require_once './Field.php';

$players = array();
$lineupType = "352";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read each field by name
    array_push($players, new Player('./player.png', 'GK', $_POST['numberGk'], $_POST['nameGk'], "blue"));
    array_push($players, new Player('./player.png', 2, $_POST['number2'], $_POST['name2']));
    array_push($players, new Player('./player.png', 3, $_POST['number3'], $_POST['name3']));
    array_push($players, new Player('./player.png', 4, $_POST['number4'], $_POST['name4']));
    array_push($players, new Player('./player.png', 5, $_POST['number5'], $_POST['name5']));
    array_push($players, new Player('./player.png', 6, $_POST['number6'], $_POST['name6']));
    array_push($players, new Player('./player.png', 7, $_POST['number7'], $_POST['name7']));
    array_push($players, new Player('./player.png', 8, $_POST['number8'], $_POST['name8']));
    array_push($players, new Player('./player.png', 9, $_POST['number9'], $_POST['name9']));
    array_push($players, new Player('./player.png', 10, $_POST['number10'], $_POST['name10']));
    array_push($players, new Player('./player.png', 11, $_POST['number11'], $_POST['name11']));
    $lineupType = $_POST['lineupType'];
}

$backgroundImage = new Field("./field.jpg", $lineupType);
// $playerGk = new Player('./player.png', 'GK', 20, "Jakub Zakrzewski", "blue");
// $player2 = new Player('./player.png', 2, 22, "Przemysław Gąsiorowski", "yellow");
// $player3 = new Player('./player.png', 3, 22, "Przemysław Gąsiorowski");
// $player4 = new Player('./player.png', 4, 22, "Przemysław Gąsiorowski", "red");
// $player5 = new Player('./player.png', 5, 22, "Przemysław Gąsiorowski", "red");
$resultFilename = './output/pitch' . bin2hex(random_bytes(16)) . '.jpg';
foreach ($players as $player) {
    $backgroundImage->addPlayer($player);
}
unset($player);
// $backgroundImage->addPlayer($playerGk);
// $backgroundImage->addPlayer($player2);
// $backgroundImage->addPlayer($player3);
// $backgroundImage->addPlayer($player4);
// $backgroundImage->addPlayer($player5);
$result = $backgroundImage->saveAs($resultFilename);
?>
<html>
<body>
<?php
echo '<img id="delayedImage" src="' . $resultFilename . '" style="display:none;">';
?>

<script>
    setTimeout(function() {
        document.getElementById('delayedImage').style.display = 'block';
    }, 2000);
</script>
</body>
</html>