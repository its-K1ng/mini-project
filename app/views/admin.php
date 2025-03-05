<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Mini Savings</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav>
        <h1>Mini Savings - Admin Dashboard</h1>
        <div>
            <a href="home">Home</a>
            <a href="logout">Logout</a>
        </div>
    </nav>

    <main>
        <h2>All Savings</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <!-- perulangan PHP untuk menampilkan data tabungan -->
                <?php foreach($savings as $saving): ?>
                    <tr>
                        <td><?php echo $saving['id']; ?></td><!-- Menampilkan id tabungan -->
                        <td><?php echo htmlspecialchars($saving['name']); ?></td>
                        <td>Rp<?php echo number_format($saving['amount']); ?></td>
                        <td><?php echo htmlspecialchars($saving['message']); ?></td>
                        <td><?php echo $saving['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>