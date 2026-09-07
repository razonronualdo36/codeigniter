<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }

        .button {
            display: inline-block;
            padding: 15px 25px;
            margin: 10px;

            background-color: #333;
            color: white;

            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <h1>My CodeIgniter Website</h1>

    <p>Choose a page to visit:</p>

    <a href="<?= base_url('about') ?>" class="button">
        About Page
    </a>

    <a href="<?= base_url('students') ?>" class="button">
        Student List
    </a>

</body>
</html>