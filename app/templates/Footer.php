<?php
namespace App\Templates;

class Footer {
    public function render() {
        ob_start();
?>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>&copy; <?php echo date('Y'); ?> Your Company Name</p>
                    </div>
                </div>
            </div>
        </footer>
<?php
        return ob_get_clean();
    }
}
