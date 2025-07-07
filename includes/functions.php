<?php
// Project/includes/functions.php
function get_featured_products() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products WHERE featured = TRUE LIMIT 4");
    return $stmt->fetchAll();
}

function get_product_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function format_price($price) {
    return number_format($price, 2, ',', '.') . ' €';
}

function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Benutzerregistrierung mit Passwort-Hashing
function register_user($email, $password) {
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    
    return $stmt->execute();
}
?>
