<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-container {
        display: flex;
        height: 100vh;
        background-image: url('../../public/uploads/drug.jpg');
        background-size: cover;
        background-position: center;
    }

    .register-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .register-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        z-index: 2;
        position: relative;
    }

    .register-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 500px;
        transition: transform 0.3s ease;
    }


    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 25px;
        padding: 12px 20px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.25);
    }

    .btn-register {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        background: linear-gradient(135deg, #dc3545 0%, #dc3545 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        opacity: 0.9;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(220,53,69,0.4);
    }

    .register-links {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 0.9rem;
    }

    .register-links a {
        color: #6c757d;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .register-links a:hover {
        color: #dc3545;
    }

    .password-requirements {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 10px;
    }
</style>

<body>
    <div class="register-container position-relative">
        <div class="register-overlay"></div>
        <div class="register-wrapper">
            <div class="register-card">
                <div class="register-header">
                    <p class="text-muted text-center">Create an Account</p>
                </div>
                <form id="register-form" method="POST" action="/register">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="userName" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required minlength="8">
                        <div class="password-requirements">
                            Password must be at least 8 characters long
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the Terms and Conditions
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-register text-white">
                        Create Account
                    </button>
                    <div class="register-links">
                        <a href="/login">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');

            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match');
                confirmPassword.focus();
            }
        });
    </script>

    <?php require_once('inc/footer.php') ?>
</body>
</html>