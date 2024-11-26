<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">Login</h3>
                <?php if (!empty($data['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $data['error']; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="/manga_shop/login">
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="login-email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="login-password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="text-center mt-3">Don't have an account? <a href="/manga_shop/register">Sign up here</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
