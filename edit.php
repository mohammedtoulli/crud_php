<?php
require_once "db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("المستخدم غير موجود");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    try {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":name" => $name, ":email" => $email, ":id" => $id]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $message = "❌ خطأ: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تعديل المستخدم</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">تعديل بيانات المستخدم</h2>
        <?php if (!empty($message)) echo "<div class='alert alert-danger'>$message</div>"; ?>
        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" value="<?= $user['name'] ?>" required>
            <input type="email" name="email" class="form-control mb-3" value="<?= $user['email'] ?>" required>
            <button type="submit" class="btn btn-primary w-100">
