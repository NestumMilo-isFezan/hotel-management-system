<?php
namespace App\Templates;

class NavGuest {
    public function render() {
        ob_start();
        // Move the contents of navguest.php here
        include_once TEMP_DIR . "/navguest.php";
        return ob_get_clean();
    }
}
