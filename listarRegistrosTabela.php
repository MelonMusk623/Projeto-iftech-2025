<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

    <?php

        echo "<h3 class='text-center'>Listar registros em uma TABELA:</h3>";

        //Query para listar TODOS os registros da tabela Professores
        $listarProfessores = "SELECT * FROM Professores";

        include "conexaoBD.php";
        //A função mysqli_query é responsável pela execução de comandos SQL no Banco de Dados
        $res = mysqli_query($conn, $listarProfessores) or die ("Erro ao tentar listar Professores!");
        $totalProfessores = mysqli_num_rows($res); //Busca o total de registros retornados pela Query

        echo "<div class='alert alert-info text-center'>Há <strong>$totalProfessores</strong> professores(s) cadastrado(s) no sistema!</div>";

        //Parte 1 - Montar o cabeçalho da tabela para exibir os registros
        echo "
            <table class='table'>
                <thead class='table-dark'>
                    <tr>
                        <th>ID</th>
                        <th>FOTO</th>
                        <th>NOME</th>
                        <th>DESCRIÇÃO</th>
                        <th>HORARIO</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
        ";

        //Parte 2 - Enquanto houver registros, executa a função abaixo para armazenar em variáveis PHP
        while($registro = mysqli_fetch_assoc($res)){
            $idProfessor        = $registro['idProfessor'];
            $fotoProfessor      = $registro['fotoProfessor'];
            $nomeProfessor      = $registro['nomeProfessor'];
            $descricaoProfessor = $registro['descricaoProfessor'];
            $horarioProfessor     = $registro['horarioProfessor'];
            $statusProfessor    = $registro['statusProfessor'];

            //Parte 3 - Exibe os horarioes armazenados nas variáveis
            echo "
                <tr>
                    <td>$idProfessor</td>
                    <td><img src='$fotoProfessor' title='Foto de $nomeProfessor' style='width:50px'></td>
                    <td>$nomeProfessor</td>
                    <td>$descricaoProfessor</td>
                    <td>$horarioProfessor</td>
                    <td>$statusProfessor</td>
                </tr>
            ";
        }
        //Parte 4 - Encerrar a tabela e a conexão com o BD
        echo "</tbody>";
        echo "</table>";
        mysqli_close($conn);
    ?>

</div>

<?php include "footer.php" ?>