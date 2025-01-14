<?php
namespace App\Templates;

class BookPart {
    public function render() {
        ob_start();
        // Move the contents of bookpart.php here
        include(TEMP_DIR . "/bookpart.php");
        return ob_get_clean();
    }
} 