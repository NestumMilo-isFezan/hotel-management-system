<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refactored Code</title>
</head>
<body>
    <div id="toast-container"></div>

    <!-- Consolidated Script Imports with SRI -->
    <script 
        src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js" 
        integrity="sha384-O+rxgys5G6T5/BkN0m91ff1hlU3Ni7VJ4gD4ShZXu/g6L3Ogl5ITknDJz8BGcDkZ" 
        crossorigin="anonymous">
    </script>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9KwDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/O0jlpcV8Qyq46cDfL" 
        crossorigin="anonymous">
    </script>
    <script src="action.js"></script>
    <script>
        // Utility function to dynamically create toast messages
        function createToast(message) {
            const toastHTML = `
                <div class="toast">
                    <div class="toast-header">
                        <strong class="mr-auto">Notification</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                    </div>
                    <div class="toast-body">${message}</div>
                </div>
            `;
            $('#toast-container').append(toastHTML);
        }

        // Example usage
        createToast('Successfully Added Hotel Service');
    </script>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="action.js"></script>
</body>
</html>
