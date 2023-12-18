<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
        }

        .error-code {
            font-size: 5em;
            color: #e74c3c;
        }

        .error-message {
            font-size: 1.5em;
            color: #333;
        }

        .error-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code"><?=$code ?></div>
        <div class="error-message"><?=$msg  ?></div>
    </div>
</body>
</html>

