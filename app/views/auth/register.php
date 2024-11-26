<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                <h3 class="card-title text-center">Register</h3>
                <?php if (!empty($data['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $data['error']; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="/manga_shop/register">
                    <div class="mb-3">
                        <label for="register-username" class="form-label">Username</label> <!-- Sửa từ 'name' thành 'username' -->
                        <input type="text" name="username" class="form-control" id="register-username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="register-email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="register-password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    <p class="text-center mt-3">Already have an account? <a href="/manga_shop/login">Login here</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
