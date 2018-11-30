<?php
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$rg = $_POST['rg'];
$codigotel = $_POST['codigotel'];
$telefone = $_POST['telefone'];
if (!empty($nome) || !empty($senha) || !empty($sexo) || !empty($email) || !empty($rg) ||
!empty($codigotel) || !empty($telefone)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "dbacademia";
  
  
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT rg From registro Where rg = ? Limit 1";
     $INSERT = "INSERT Into registro (nome, senha, sexo, email, rg, codigotel, telefone) values(?, ?, ?, ?, ?, ?, ?)";
   
   
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $rg);
     $stmt->execute();
     $stmt->bind_result($rg);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssii", $nome, $senha, $sexo, $email, $rg, $codigotel, $telefone);
      $stmt->execute();
      echo '<p style="color: green;"> Cadastro realizado com sucesso!</p>';
     } else {
      echo '<p style="color: red;">
      Já existe um usário cadastrado com este RG
      </p>';
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "Todos os campos são obrigatórios";
 die();
}
?>