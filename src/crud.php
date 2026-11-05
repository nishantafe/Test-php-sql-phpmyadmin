<?php
// Full CRUD example: Create, Read, Update, Delete on the "books" table
$pdo = new PDO(
    'mysql:host=db;dbname=school;charset=utf8mb4',
    'student',
    'student',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {                                   // CREATE
        $pdo->prepare('INSERT INTO books (title, author) VALUES (?, ?)')
            ->execute([$_POST['title'], $_POST['author']]);
    } elseif ($action === 'update') {                             // UPDATE
        $pdo->prepare('UPDATE books SET title = ?, author = ? WHERE id = ?')
            ->execute([$_POST['title'], $_POST['author'], $_POST['id']]);
    } elseif ($action === 'delete') {                             // DELETE
        $pdo->prepare('DELETE FROM books WHERE id = ?')
            ->execute([$_POST['id']]);
    }

    header('Location: crud.php');
    exit;
}

// Row being edited (if any): crud.php?edit=3
$editing = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
    $stmt->execute([$_GET['edit']]);
    $editing = $stmt->fetch(PDO::FETCH_ASSOC);
}

// READ
$books = $pdo->query('SELECT * FROM books ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Books CRUD</title>
</head>
<body>
  <p><a href="index.php">&larr; Back</a></p>
  <h1>Books</h1>

  <table border="1" cellpadding="6">
    <tr><th>ID</th><th>Title</th><th>Author</th><th>Actions</th></tr>
    <?php foreach ($books as $b): ?>
      <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['author']) ?></td>
        <td>
          <a href="crud.php?edit=<?= $b['id'] ?>">Edit</a>
          <form method="post" style="display:inline" onsubmit="return confirm('Delete?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $b['id'] ?>">
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2><?= $editing ? 'Edit book' : 'Add book' ?></h2>
  <form method="post">
    <input type="hidden" name="action" value="<?= $editing ? 'update' : 'create' ?>">
    <?php if ($editing): ?>
      <input type="hidden" name="id" value="<?= $editing['id'] ?>">
    <?php endif; ?>
    <input type="text" name="title" placeholder="Title" required
           value="<?= htmlspecialchars($editing['title'] ?? '') ?>">
    <input type="text" name="author" placeholder="Author" required
           value="<?= htmlspecialchars($editing['author'] ?? '') ?>">
    <button type="submit"><?= $editing ? 'Save' : 'Add' ?></button>
    <?php if ($editing): ?><a href="crud.php">Cancel</a><?php endif; ?>
  </form>
</body>
</html>
