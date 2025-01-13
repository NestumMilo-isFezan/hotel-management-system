<?php
class ErrorHandler {
    public static function handleError($error, $type = 'default') {
        $response = [
            'status' => 'error',
            'message' => self::getErrorMessage($error, $type)
        ];
        return json_encode($response);
    }

    private static function getErrorMessage($error, $type) {
        $errorMessages = [
            'booking_not_found' => 'Booking record not found',
            'invalid_status' => 'Invalid booking status',
            'database_error' => 'Database operation failed',
            'default' => 'An unexpected error occurred'
        ];
        return $errorMessages[$error] ?? $errorMessages['default'];
    }
}
?>
