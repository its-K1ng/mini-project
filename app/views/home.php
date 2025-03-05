<!DOCTYPE html>
<html>
<head>
    <title>Home - Mini Savings</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav>
        <h1>Mini Savings</h1>
        <?php if(isset($_SESSION['user_id'])): ?>
            <div>
                Welcome, <?php echo $_SESSION['user_name']; ?>
                <?php if($_SESSION['user_role'] === 'admin'): ?>
                    <a href="admin">Admin Dashboard</a>
                <?php endif; ?>
                <a href="save">Save</a>
                <a href="logout">Logout</a>
            </div>
        <?php else: ?>
            <div>
                <a href="login">Login</a>
                <a href="register">Register</a>
            </div>
        <?php endif; ?>
    </nav>

    <main>
        <h2>Recent Saving</h2>
        <?php foreach($savings as $Saving): ?>
            <div class="Saving-card">
                <h3><?php echo htmlspecialchars($Saving['name']); ?></h3>
                <p>Amount: Rp<?php echo number_format($Saving['amount']); ?></p>
                <p>Message: <?php echo htmlspecialchars($Saving['message']); ?></p>
                <small>Date: <?php echo $Saving['created_at']; ?></small>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>