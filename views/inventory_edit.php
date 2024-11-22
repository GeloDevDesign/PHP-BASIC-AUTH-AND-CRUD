<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Inventory</title>
</head>
<body>
    <h2>Edit Inventory Item</h2>
    <form method="POST">
        <input type="text" name="item_name" value="<?= $inventory['item_name'] ?>" required>
        <input type="number" name="quantity" value="<?= $inventory['quantity'] ?>" required>
        <textarea name="description"><?= $inventory['description'] ?></textarea>
        <button type="submit">Update Item</button>
    </form>
</body>
</html>
