<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
</head>
<body>
    <h2>Users List</h2>
    <a href="index.php?action=logout">Logout</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td>
                    <a href="index.php?action=delete&id=<?= $user['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
