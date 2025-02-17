<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
        display: flex;
        height: 100vh;
        background-image: url('../../public/uploads/drug.jpg');
        background-size: cover;
        background-position: center;
    }

    .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        z-index: 2;
        position: relative;
    }

    .login-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 450px;
        transition: transform 0.3s ease;
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-header h2 {
        color: #dc3545;
        font-weight: 700;
        margin-bottom: 10px;
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

    .btn-login {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        background: linear-gradient(135deg, #dc3545 0%, #dc3545 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        opacity: 0.9;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(220,53,69,0.4);
    }

    .login-links {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 0.9rem;
    }

    .login-links a {
        color: #6c757d;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .login-links a:hover {
        color: #dc3545;
    }
</style>

<body>
    <div class="login-container position-relative">
        <div class="login-overlay"></div>
        <div class="login-wrapper">
            <div class="login-card">
                <div class="login-header">
                    <p class="text-muted text-center">Sign in to your account</p>
                </div>
                <form id="ulogin-form" method="POST" action="">
                    <div class="form-group mb-3">
                        <input type="text" name="userName" class="form-control" placeholder="Username" autofocus required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-login text-white">
                        Sign In
                    </button>
                    <div class="login-links">
                        <a href="/">Go to Website</a>
                        <a href="/register">Create an Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>