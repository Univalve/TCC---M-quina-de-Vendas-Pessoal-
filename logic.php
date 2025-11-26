<?php
// ====================== CONFIGURAÇÃO E CONEXÃO COM BANCO ======================
$host = 'localhost';
$user = 'root';
$pass = '';           // geralmente vazio no XAMPP
$dbname = 'contato';

$mensagem = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria o banco e a tabela automaticamente se não existirem
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbname`");
    $pdo->exec("CREATE TABLE IF NOT EXISTS contato (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(50) NOT NULL,
        `E-mail` VARCHAR(50) NOT NULL,
        Mensagens VARCHAR(500) NOT NULL,
        data_envio DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

    // Processa o envio do formulário
    if ($_POST && isset($_POST['enviar'])) {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $msg = trim($_POST['mensagem'] ?? '');

        if ($nome === '' || $email === '' || $msg === '') {
            $mensagem = '<span style="color:#e74c3c;">Todos os campos são obrigatórios!</span>';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem = '<span style="color:#e74c3c;">E-mail inválido!</span>';
        } else {
            $sql = "INSERT INTO contato (Nome, `E-mail`, Mensagens) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $msg]);
            $mensagem = '<span style="color:#27ae60;">Mensagem enviada com sucesso! Obrigado!</span>';
        }
    }
} catch (Exception $e) {
    $mensagem = '<span style="color:#e74c3c;">Erro de conexão com o banco.</span>';
}
?>
