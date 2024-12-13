<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>75% / 25% Layout with Style</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        nav {
            background: #333;
            color: white;
            display: block;
            justify-content: flex-start;
            text-align: right;
        }

        nav a {
            background: #333;
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh; /* Full viewport height */
        }

        .main-content {
            width: 75%;
            padding: 20px;
            background-color: #f0f0f0;
            text-align: center;
        }

        .sidebar {
            width: 25%;
            padding: 20px;
            background-color: #ccc;
            text-align: center;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin: 10px;
            padding: 20px;
            width: 250px;
        }

        .card h3 {
            margin-top: 0;
            color: #333;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .card a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>我的資料</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>
    <div class="container">
        <div class="main-content">
            <h1>Main Content</h1>
            <p>This section takes up 75% of the width.</p>
            <div class="card">
                <h3>Card Title</h3>
                <p>Card description goes here.</p>
                <a href="#">Read More</a>
            </div>
        </div>
        <div class="sidebar">
            <h2>Sidebar</h2>
            <p>This section takes up 25% of the width.</p>
        </div>
    </div>
</body>
</html>
