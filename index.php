<?php
require_once "db.php";

$stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>قائمة المستخدمين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">قائمة المستخدمين</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                            <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟');">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-success w-100">إضافة مستخدم جديد</a>
    </div>
</body>
</html>

