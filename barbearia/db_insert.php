<?php
include("db_config.php");

$cliente = $_POST['cliente'];
$telefone = $_POST['telefone'];
$funcionarias = $_POST['funcionarias'];
$data_agendamento = $_POST['data_agendamento'];
$hora_agendamento = $_POST['hora_agendamento'];
$forma_De_pagamento = $_POST['forma_De_pagamento'];

$stmt = $conn->prepare("INSERT INTO agendamento (clienteS, telefone, funcionarias, data_agendamento, hora_agendamento, forma_De_pagamento) VALUES (?, ?, ?, ?, ?, ? )");

$stmt->bind_param("sissss", $cliente, $telefone, $funcionarias, $data_agendamento, $hora_agendamento, $forma_De_pagamento);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
      body {
         background-color: dodgerblue;
      }

      .sucesso {
         color: green;
         font-size: 20px;
         font-weight: bold;
         border: 2px solid green;
         padding: 10px;
         width: fit-content;
         margin: 20px auto;
         text-align: center;
         background-color: #e6ffe6;
         border-radius: 5px;
      }

      .erro {
         color: red;
         font-size: 20px;
         font-weight: bold;
         border: 2px solid red;
         padding: 10px;
         width: fit-content;
         margin: 20px auto;
         text-align: center;
         background-color: #ffe6e6;
         border-radius: 5px;
      }
   </style>
</head>

<body>
   <?php
   if ($stmt->execute()) {
      echo "<div class='sucesso'>Agendamento realizado com sucesso!</div>";
   } else {
      echo "<div class='erro'>Erro no agendamento: " . $stmt->error . "</div>";
   }
   ?>
</body>

</html>