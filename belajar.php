<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | WSI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
        }

        .center-wrapper {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .btn-custom {
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 30px;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="center-wrapper">
        <div class="welcome-card">
            <h1>Welcome to WSI</h1>
            <p>Sistem Informasi berbasis web untuk pengelolaan data secara cepat dan mudah.</p>
            <a href="tabel.php" class="btn btn-primary btn-custom">
                Masuk ke Sistem
            </a>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
