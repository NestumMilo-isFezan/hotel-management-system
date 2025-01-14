<?php
namespace App\Templates;

class Footer {
    public function render() {
        ob_start();
        // Move the contents of footer.php here
        include_once TEMP_DIR . "/footer.php";
        return ob_get_clean();
    }
}
