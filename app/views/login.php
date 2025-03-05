<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini Savings</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="body">
    <nav class="nav">
        <h1>Mini Savings</h1>
        <a class="a" href="home">Home</a>
    </nav>

    <main class="main">
        <h2>Login</h2>
        <form method="POST" action="login">
            <div>
                <label>Email</label>
                <input class="blue-input" type="email" name="email" required>
            </div>
            <div>
                <label>Password</label>
                <input class="blue-input" type="password" name="password" required>
            </div>
            <button class="blue-button" type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register">Register!</a></p>
    </main>
</body>
</html>