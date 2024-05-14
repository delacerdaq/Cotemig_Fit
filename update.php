<?php
echo "Atualizando dados abaixo... <br>";

// Ensure your database connection is properly set up
require('conexao.php');

// Get the ID from POST data, or any other source
$id = $_POST["id"] ?? "";  // If no ID is passed, it's an empty string

// Check the request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch values from POST request
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $endereco = $_POST["endereco"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $modalidade = $_POST["modalidade"];
    
    echo "<hr>";

    // Function to update the database record
    function atualizarRegistro($pdo, $id, $nome, $email, $sexo, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $modalidade) {
        // Corrected SQL statement with missing comma
        $sql = "UPDATE alunos 
                SET nome = :nome, 
                    email = :email, 
                    sexo = :sexo, 
                    endereco = :endereco, 
                    numero = :numero, 
                    complemento = :complemento, 
                    bairro = :bairro, 
                    cidade = :cidade, 
                    uf = :estado, 
                    modalidade = :modalidade 
                WHERE idAluno = :id"; 
        
        // Use named parameters to prevent SQL injection and ensure safety
        $stmt = $pdo->prepare($sql);
        // Bind values to parameters
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);
        $stmt->bindParam(':complemento', $complemento, PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':modalidade', $modalidade, PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    // Call the function to update the record
    if (atualizarRegistro($pdo, $id, $nome, $email, $sexo, $endereco, $numero, $complemento, $bairro, $cidade, $estado, $modalidade)) {
        echo "Registro atualizado com sucesso!<br>" . "<a href='index.php'>HOME</a>";
    } else {
        echo 'Erro ao inserir o registro.';
    }
}
?>

