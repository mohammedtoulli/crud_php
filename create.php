<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":name" => $name, ":email" => $email, ":password" => $password]);
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
    <title>إنشاء مستخدم</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">إضافة مستخدم جديد</h2>
        <?php if (!empty($message)) echo "<div class='alert alert-danger'>$message</div>"; ?>
        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="الاسم" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="كلمة المرور" required>
            <button type="submit" class="btn btn-primary w-100">إضافة</button>
        </form>
    </div>
</body>
</html>
