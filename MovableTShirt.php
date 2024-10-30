
<?php
class MovableTShirt {
    private $backgroundImage;
    private $defaultNumber;
    private $defaultName;

    // Constructor to initialize the t-shirt properties
    public function __construct($backgroundImage = "player.png", $defaultNumber = "00", $defaultName = "Your Name") {
        $this->backgroundImage = $backgroundImage;
        $this->defaultNumber = $defaultNumber;
        $this->defaultName = $defaultName;
    }
    
    public function getDefaultName() {
        return $this->defaultName;
    }

    // Method to render the t-shirt HTML and JavaScript
    public function render() {
        echo <<<HTML
        <div class="main-container">
            <!-- Draggable T-shirt container -->
            <div class="tshirt-container" id="tshirtContainer">
                <!-- T-shirt background image -->
                <img src="{$this->backgroundImage}" class="tshirt-image" alt="T-Shirt Image">
            
                <!-- Movable number and name elements -->
                <div class="movable tshirt-number" id="tshirtNumber">{$this->defaultNumber}</div>
                <div class="movable tshirt-name" id="tshirtName">{$this->defaultName}</div>
            </div>
        </div>
        
        <!-- Form to input the t-shirt number and name -->
        <div class="form-container">
            <form>
                <label for="number">Number:</label>
                <input type="text" id="number" placeholder="Enter Number" oninput="updateText('tshirtNumber', this.value)">
                <br><br>
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="Enter Name" oninput="updateText('tshirtName', this.value)">
            </form>
        </div>
HTML;
        $this->renderStylesAndScripts();
    }

    // Method to render necessary CSS and JavaScript
    private function renderStylesAndScripts() {
        echo <<<STYLE
        <style>
            /* Container for the T-shirt and movable text */
            .main-container {
                width: 100%;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
                // background-color: #eaeaea;
            }
            
            /* T-shirt container that is draggable */
            .tshirt-container {
                position: absolute;
                width: 300px;
                height: 400px;
                border: 1px solid #ddd;
                background-color: #f9f9f9;
                z-index: 1000;
                cursor: move;
            }

            /* T-shirt background image */
            .tshirt-image {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 1;
            }

            /* Movable elements for the number and name */
            .movable {
                position: absolute;
                cursor: move;
                font-family: Arial, sans-serif;
                font-weight: bold;
                color: #333;
                z-index: 2;
            }

            /* Styling for specific text elements */
            .tshirt-number {
                font-size: 48px;
                top: 50px;
                left: 120px;
            }

            .tshirt-name {
                font-size: 24px;
                top: 340px;
                left: 100px;
            }

            /* Form styling */
            .form-container {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                text-align: center;
                z-index: 3;
            }
        </style>
STYLE;

        echo <<<SCRIPT
        <script>
            // Function to update text dynamically based on input
            function updateText(elementId, text) {
                document.getElementById(elementId).textContent = text;
            }

            // Enable dragging for the t-shirt container
            function enableDragging(elementId) {
                const element = document.getElementById(elementId);
                let offsetX, offsetY;

                element.addEventListener("mousedown", (e) => {
                    offsetX = e.clientX - element.offsetLeft;
                    offsetY = e.clientY - element.offsetTop;
                    document.addEventListener("mousemove", mouseMove);
                    document.addEventListener("mouseup", mouseUp);
                });

                function mouseMove(e) {
                    element.style.left = (e.clientX - offsetX) + "px";
                    element.style.top = (e.clientY - offsetY) + "px";
                }

                function mouseUp() {
                    document.removeEventListener("mousemove", mouseMove);
                    document.removeEventListener("mouseup", mouseUp);
                }
            }

            // Enable dragging for the main container (moves everything on the t-shirt together)
            enableDragging("tshirtContainer");

            // Enable dragging for the number and name elements individually
            // enableDragging("tshirtNumber");
            // enableDragging("tshirtName");
        </script>
SCRIPT;
    }
}
