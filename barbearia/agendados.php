<?php
// Inclui o arquivo de configuração do banco de dados
include("db_config.php");

// Prepara a consulta SQL para selecionar os dados da tabela 'agendamento'
$stmt = $conn->prepare("SELECT 
                            clienteS,
                            funcionariaS,
                            data_agendamento,
                            hora_agendamento,
                            forma_De_pagamento,
                            telefone
                        FROM 
                            agendamento;");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamentos</title>
  <style>
    .agendamentos {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      /* Remove espaços entre bordas das células */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      /* Sombra suave */
      font-family: sans-serif;
      background-color: #f9f9f9;
    }

    .agendamentos th,
    .agendamentos td {
      border: 1px solid #ddd;
      /* Bordas finas */
      padding: 12px;
      /* Espaçamento interno */
      text-align: center;
      font-size: 1em;
    }

    .agendamentos th {
      background-color: #4ec7ec;
      /* Cor de destaque para cabeçalhos */
      color: white;
      /* Cor do texto */
      font-weight: bold;
    }

    .agendamentos tr:nth-child(even) {
      background-color: #f2f2f2;
      /* Cor alternada para linhas pares */
    }

    .agendamentos tr:hover {
      background-color: #c6e3f0;
      /* Destaque ao passar o mouse */
    }
  </style>
</head>

<body>
  <?php
  // Verifica se a preparação da consulta foi bem-sucedida
  if ($stmt) {
    // Executa a consulta preparada
    $stmt->execute();
    // Obtém o resultado da consulta
    $resultado = $stmt->get_result();

    // Verifica se há algum registro retornado
    if ($resultado->num_rows > 0) {
      // Inicia a tabela HTML para exibir os agendamentos
      echo "<table class='agendamentos'>";
      // Define os cabeçalhos da tabela
      echo "<tr><th>CLIENTE</th> <th>TELEFONE</th> <th>FUNCIONÁRIO</th> <th>DATA</th> <th>HORÁRIO</th><th>PAGAMENTO</th></tr>";

      // Loop através de cada linha do resultado
      while ($row = $resultado->fetch_assoc()) {
        // Inicia uma nova linha na tabela
        echo "<tr>";
        // Exibe os dados de cada coluna, utilizando htmlspecialchars para segurança
        echo "<td>" . htmlspecialchars($row["clienteS"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["funcionariaS"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["data_agendamento"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["hora_agendamento"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["forma_De_pagamento"]) . "</td>";
        // Fecha a linha da tabela
        echo "</tr>";
      }
      // Fecha a tabela HTML
      echo "</table>";
    } else {
      // Exibe uma mensagem caso não haja agendamentos
      echo "Nenhum agendamento encontrado.";
    }
    // Fecha a declaração preparada
    $stmt->close();
  } else {
    // Exibe uma mensagem de erro caso a preparação da consulta falhe
    echo "Erro ao preparar a consulta: " . $conn->error;
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
  ?>
</body>

</html>