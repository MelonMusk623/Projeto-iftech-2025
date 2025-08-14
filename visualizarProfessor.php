<?php include "header.php" ?>

<div class="container text-center mt-5 mb-5">

    <div class="row text-center">

        <?php

            //Verifica se há recebimento de parâmetro via método GET
            if(isset($_GET['idProfessor'])){
                $idProfessor = $_GET['idProfessor'];

                //Inclui o arquivo de conexão com o Banco de Dados
                include "conexaoBD.php";

                $exibirProfessor = "SELECT * FROM Professores WHERE idProfessor = $idProfessor";
                $res           = mysqli_query($conn, $exibirProfessor); //Executa a QUERY
                $totalProfessor = mysqli_num_rows($res); //Retorna a quantidade de registros

                if($totalProfessor > 0){
                    if($registro = mysqli_fetch_assoc($res)){
                        $idProfessor        = $registro['idProfessor'];
                        $fotoProfessor      = $registro['fotoProfessor'];
                        $nomeProfessor      = $registro['nomeProfessor'];
                        $descricaoProfessor = $registro['descricaoProfessor'];
                        $horarioProfessor     = $registro['horarioProfessor'];
                        $statusProfessor    = $registro['statusProfessor'];

                        ?>

                        <div class="d-flex justify-content-center mb-3">

                            <div class="card" style="width:30%; border-style:none;">
                                            
                                <!-- Carousel -->
                                <div id="Professor" class="carousel slide" data-bs-ride="carousel" >

                                    <!-- Indicators/dots -->
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#Professor" data-bs-slide-to="0" class="active"></button>
                                        <button type="button" data-bs-target="#Professor" data-bs-slide-to="1"></button>
                                        <button type="button" data-bs-target="#Professor" data-bs-slide-to="2"></button>
                                    </div>

                                    <!-- The slideshow/carousel -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class='position-relative'>
                                                <?php
                                                    if($statusProfessor == 'esgotado'){
                                                        echo "
                                                            <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-4 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                                                ESGOTADO
                                                            </div>
                                                        ";
                                                    }
                                                    echo "
                                                        <img class='d-block w-100' src='$fotoProfessor' alt='Foto de $nomeProfessor' ";
                                                            if($statusProfessor == 'esgotado'){
                                                                echo "style='filter:grayscale(100%)' ";
                                                            }
                                                        echo ">";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class='position-relative'>
                                                <?php
                                                    if($statusProfessor == 'esgotado'){
                                                        echo "
                                                            <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-4 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                                                ESGOTADO
                                                            </div>
                                                        ";
                                                    }
                                                    echo "
                                                        <img class='d-block w-100' src='$fotoProfessor' alt='Foto de $nomeProfessor' ";
                                                            if($statusProfessor == 'esgotado'){
                                                                echo "style='filter:grayscale(100%)' ";
                                                            }
                                                        echo ">";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class='position-relative'>
                                                <?php
                                                    if($statusProfessor == 'esgotado'){
                                                        echo "
                                                            <div class='position-absolute top-50 start-50 translate-middle bg-danger text-white px-4 py-2 fs-6 fw-bold rounded shadow' style='z-index: 10; opacity: 0.85;'>
                                                                ESGOTADO
                                                            </div>
                                                        ";
                                                    }
                                                    echo "
                                                        <img class='d-block w-100' src='$fotoProfessor' alt='Foto de $nomeProfessor' ";
                                                            if($statusProfessor == 'esgotado'){
                                                                echo "style='filter:grayscale(100%)' ";
                                                            }
                                                        echo ">";
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Left and right controls/icons -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#Professor" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#Professor" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                                
                                <div class="card-body">
                                <h4 class="card-title"><b><?php echo $nomeProfessor ?></b></h4>
                                <p class="card-text"><?php echo $descricaoProfessor ?></p>

                                <?php
                                    // Verifica se o horário do professor foi fornecido e formata corretamente
                                    if (!empty($horarioProfessor)) {
                                        // Cria um objeto DateTime a partir do horário do professor
                                        $date = DateTime::createFromFormat('H:i:s', $horarioProfessor);
                                        // Verifica se a criação foi bem-sucedida antes de exibir
                                        if ($date) {
                                            $horarioFormatado = $date->format('H:i');
                                        } else {
                                            $horarioFormatado = $horarioProfessor; // Caso não consiga formatar
                                        }
                                    } else {
                                        $horarioFormatado = "Horário não disponível"; // Caso não tenha horário
                                    }
                                ?>

                                <p class="card-text">horário: <b> <?php echo $horarioFormatado ?></b></p>
                                
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <?php
                                            if ($statusProfessor != 'esgotado') {
                                                echo "
                                                    <a href='#' title='Comprar $nomeProfessor'>
                                                        <button class='btn btn-outline-success'>
                                                            <i class='bi bi-bag-plus' style='font-size:16pt;'></i>
                                                            Comprar
                                                        </button>
                                                    </a>
                                                ";
                                            } else {
                                                echo "
                                                    <div class='alert alert-secondary'>
                                                        Professor Esgotado! <i class='bi bi-emoji-frown'></i>
                                                    </div>
                                                ";
                                            }
                                        ?>
                                    </div>
                                    <br>
                                </div>
                            </div>


                            </div>

                        </div>

                    <?php

                    }
                }
                else{
                    echo "<div class='alert alert-warning text-center'>Professor não localizado!</div>";
                }

            }
            else{
                echo "<div class='alert alert-warning text-center'>Não foi possível carregar o Professor!</div>";
            }

        ?>

        

    </div>

</div>

<?php include "footer.php" ?>