<?php
$title = "Login";
include("template/auth/header.php");

require_once('function.php');

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
$logoutMessage = isset($_SESSION['logout_message']) ? $_SESSION['logout_message'] : null;
$middleware = isset($_SESSION['middleware']) ? $_SESSION['middleware'] : null;

unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
unset($_SESSION['logout_message']);
unset($_SESSION['middleware']);
?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <h3>Audit Kendaraan</h3>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <?php if ($successMessage) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $successMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($errorMessage) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $errorMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($logoutMessage) : ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?php echo $logoutMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if ($middleware) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $middleware; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="text" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your username
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <!-- <div class="float-right">
                                        <a href="auth-forgot-password.html" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div> -->
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Belum punya akun? <a href="register.php">Create One</a>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Audit 2024
                </div>
            </div>
        </div>
    </div>
</section>


<?php include("template/auth/footer.php") ?>