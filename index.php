<?php include "header.php" ?>

<div class='container mt-5 mb-5'>

    <?php

        //Inclui o arquivo de conexão com o Banco de Dados
        include "conexaoBD.php";

        //Variável PHP que recebe a Query para selecionar todos os campos da tabela Professores
        $listarProfessores = "SELECT * FROM Professores";

        //Verificar se há algum parâmetro chamado filtroProfessor sendo recebido por GET
        if(isset($_GET['filtroProfessor'])){
            //Se houver horario setado no GET chamado 'filtroProfessor', armazena na variável $
            $filtroProfessor = $_GET['filtroProfessor'];

            //Se o filtro for diferente de 'todos', concatena a filtragem
            if($filtroProfessor != 'todos'){
                $listarProfessores = $listarProfessores . " WHERE statusProfessor LIKE '$filtroProfessor' ";
            }

            switch($filtroProfessor){
                case "todos" : $mensagemFiltro = "no total";
                break;

                case "disponivel" : $mensagemFiltro = "disponíveis";
                break;

                case "esgotado" : $mensagemFiltro = "esgotados";
                break;
            }

        }
        else{
            $filtroProfessor = "todos";
            $mensagemFiltro = "no total";
        }

        $res            = mysqli_query($conn, $listarProfessores); //Recebe true OR false com base na execução
        $totalProfessores  = mysqli_num_rows($res); //Retorna a quantidade de registros encontrados

        if($totalProfessores > 0){
            if($totalProfessores == 1){
                //Se o total de Professores for igual a um, exibe mensagem no singular
                echo "<div class='alert alert-info text-center'>Há <strong>$totalProfessores</strong> Professor $mensagemFiltro cadastrado!</div>";
            }
            else{
                //Se o total de Professores não for igual a um, exibe mensagem no plural
                echo "<div class='alert alert-info text-center'>Há <strong>$totalProfessores</strong> Professores $mensagemFiltro cadastrados!</div>";
            }
        }
        else{
            echo "<div class='alert alert-info text-center'>Não há Professores cadastrados no sistema!</div>";
        }

        

    ?>

    <hr>

    <!-- Exibe a grid com os cards -->
    <div class="row">

        <?php
            //Loop para armazenar os registros da tabela em variáveis PHP
            while($registro = mysqli_fetch_assoc($res)){
                $idProfessor        = $registro['idProfessor'];
                $fotoProfessor      = $registro['fotoProfessor'];
                $nomeProfessor      = $registro['nomeProfessor'];
                $descricaoProfessor = $registro['descricaoProfessor'];
                $horarioProfessor     = $registro['horarioProfessor'];
                $statusProfessor    = $registro['statusProfessor'];

                echo "
    <div class='col-sm-3'>
        <div class='card' style='width:100%; height:100%'>
            <div class='card-body' style='height:100%'>
                <a href='visualizarProfessor.php?idProfessor=$idProfessor' style='text-decoration:none' title='Visualizar mais detalhes de $nomeProfessor'>
                    <div class='position-relative'>
                        ";

                        if ($statusProfessor == 'esgotado') {
                            echo "
                                <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-4 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                    ESGOTADO
                                </div>
                            ";
                        }

                        echo "
                        <img class='card-img-top' src='$fotoProfessor' alt='Foto de $nomeProfessor' ";
                            if ($statusProfessor == 'esgotado') {
                                echo "style='filter:grayscale(100%)' ";
                            }
                        echo ">
                    </div>
                </a>
            </div>

            <div class='card-body text-center'>
                <h4 class='card-title'>$nomeProfessor</h4>";

                // Verifica e formata o horário do professor
                if (!empty($horarioProfessor)) {
                    $date = DateTime::createFromFormat('H:i:s', $horarioProfessor);
                    if ($date) {
                        $horarioFormatado = $date->format('H:i');
                    } else {
                        $horarioFormatado = $horarioProfessor; // Caso não consiga formatar
                    }
                } else {
                    $horarioFormatado = "Horário não disponível"; // Caso não tenha horário
                }

                echo "<p class='card-text'>horário: <strong>$horarioFormatado</strong>";

                echo "
                <div class='d-grid' style='border-size:border-box'>
                    <a class='btn btn-outline-success' href='visualizarProfessor.php?idProfessor=$idProfessor' style='text-decoration:none' title='Visualizar mais detalhes de $nomeProfessor'>
                        <i class='bi bi-eye'></i> Visualizar Professor
                    </a>
                </div>
            </div>

        </div> 
    </div>
";

            }
        ?>

    </div>

</div>

<?php include "footer.php" ?>