<?php
require_once "db.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([":id" => $id]);
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("❌ خطأ: " . $e->getMessage());
    }
}
?>
