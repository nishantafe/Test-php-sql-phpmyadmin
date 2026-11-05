<?php
// Connect to MySQL (host "db" = the database container)
$pdo = new PDO(
    'mysql:host=db;dbname=school;charset=utf8mb4',
    'student',
    'student',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// Add a student when the form is submitted!
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    $stmt = $pdo->prepare('INSERT INTO students (name) VALUES (?)');
    $stmt->execute([$_POST['name']]);
    header('Location: /');
    exit;
}

// Read all students
$students = $pdo->query('SELECT id, name FROM students ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP + MySQL</title>
</head>
<body>
  <p><a href="crud.php">See the full CRUD example (books) &rarr;</a></p>
  <h1>Students</h1>

  <ul>
    <?php foreach ($students as $s): ?>
      <li><?= $s['id'] ?> - <?= htmlspecialchars($s['name']) ?></li>
    <?php endforeach; ?>
  </ul>

  <form method="post">
    <input type="text" name="name" placeholder="New student name" required>
    <button type="submit">Add</button>
  </form>
</body>
</html>
