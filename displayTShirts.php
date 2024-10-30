<?php
// Include the MovableTShirt class
require_once 'MovableTShirt.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Movable T-Shirts on Field</title>
    <style>
        /* Background container for the field */
        .field-container {
            width: 100vw;
            height: 100vh;
            position: relative;                   /* Relative positioning to contain t-shirts */
            display: flex;
/*            align-items: center;
            justify-content: center; */
            overflow: auto;                       /* Allow scrolling if image overflows */
        }

        /* Field image at its natural size, centered within the container */
        .field-image {
            position: absolute;
/*            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);      /* Center the image in the viewport */ */
        }

        /* Adjust positioning for t-shirts */
        .tshirt-container {
            position: absolute;                    /* Position absolute within the field */
            z-index: 1;                            /* Ensure it's above the background image */
            cursor: move;                          /* Make it draggable */
        }
    </style>
</head>
<body>
<?php phpinfo();?>
<div class="field-container">
    <!-- Display the field.jpg image without scaling -->
    <img src="field.jpg" class="field-image" alt="Field Background">
    
    <?php
        // Create and render t-shirt instances on top of the field
        $tshirt1 = new MovableTShirt();
        $tshirt1->render();

        // Optionally, add another t-shirt instance
        $tshirt2 = new MovableTShirt("tshirt2.png", "99", "Custom Name");
        $tshirt2->render();
    ?>
</div>

</body>
</html>
