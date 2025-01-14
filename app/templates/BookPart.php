<?php
namespace App\Templates;

class BookPart {
    public function render() {
        ob_start();
?>
        <div class="book-part">
            <!-- Move the HTML/PHP content directly here instead of including -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Book Section</h2>
                        <!-- Add your book-related content here -->
                    </div>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
}
