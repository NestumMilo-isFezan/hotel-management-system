<!-- Login Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="loginform">
            <div class="modal-header">
                <h5 class="modal-title">Log-In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="loginemail" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="loginemail" required>
                </div>
                <div class="mb-3">
                    <label for="loginpass" class="form-label">Password :</label>
                    <input type="password" class="form-control" id="loginpass" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </div>
        </form>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registermodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="registerform">
            <div class="modal-header">
                <h5 class="modal-title">Sign-Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="registeremail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="registeremail" required>
                </div>
                <div class="mb-3">
                    <label for="regpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="regpassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmpass" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpass" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="registernow" class="btn btn-primary w-100">Register</button>
            </div>
        </form>
    </div>
</div>

<!-- Toasts -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="guestToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">Welcome Back Guest! Redirecting...</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="staffToast" class="toast align-items-center text-bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">Welcome Staff! Redirecting to Dashboard...</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="addToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">Success! Redirecting...</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">An error occurred. Please try again.</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
