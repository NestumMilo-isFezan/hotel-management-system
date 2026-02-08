class ErrorHandler {
    static showError(error, elementId = 'error-toast') {
        const errorToast = document.getElementById(elementId);
        if (errorToast) {
            errorToast.querySelector('.toast-body').textContent =
                typeof error === 'string' ? error : 'An error occurred';
            const toast = new bootstrap.Toast(errorToast);
            toast.show();
        }
    }

    static async handleFetchError(response) {
        if (!response.ok) {
            const error = await response.json();
            this.showError(error.message);
            throw new Error(error.message);
        }
        return response;
    }
}
