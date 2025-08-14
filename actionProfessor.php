<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <div class="container mt-3 mb-3">

        <?php

            //Verifica o método de requisição do servidor
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //Bloco para declaração de variáveis
                $fotoProfessor = $nomeProfessor = $descricaoProfessor = $horarioProfessor = "";

                //Variável booleana para controle de erros de preenchimento
                $erroPreenchimento = false;

                //Validação do campo nomeProfessor
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["nomeProfessor"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena horario do formulário na variável
                    $nomeProfessor = filtrar_entrada($_POST["nomeProfessor"]);
                }

                //Validação do campo descricaoProfessor
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["descricaoProfessor"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>DESCRIÇÃO</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena horario do formulário na variável
                    $descricaoProfessor = filtrar_entrada($_POST["descricaoProfessor"]);
                }

                //Validação do campo horarioProfessor
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["horarioProfessor"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>horario</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena horario do formulário na variável
                    $horarioProfessor = filtrar_entrada($_POST["horarioProfessor"]);
                }

                //Início da validação da foto do Professor
                $diretorio    = "img/"; //Define para qual diretório as imagens serão movidas
                $fotoProfessor  = $diretorio . basename($_FILES['fotoProfessor']['name']); //img/joaozinho.jpg
                $tipoDaImagem = strtolower(pathinfo($fotoProfessor, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas
                $erroUpload   = false; //Variável para controle do upload da foto

                //Verifica se o tamanho do arquivo é DIFERENTE DE ZERO
                if($_FILES['fotoProfessor']['size'] != 0){

                    //Verifica se o tamanho do arquivo é maior do que 5 MegaBytes (MB) - Medida em Bytes
                    if($_FILES['fotoProfessor']['size'] > 5000000){
                        echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                        $erroUpload = true;
                    }

                    //Verifica se a foto está nos formatos JPG, JPEG, PNG ou WEBP
                    if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                        echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar nos formatos JPG, JPEG, PNG ou WEBP</div>";
                        $erroUpload = true;
                    }

                    //Verifica se a imagem foi movida para o diretório IMG, utilizando a função move_uploaded_file
                    if(!move_uploaded_file($_FILES['fotoProfessor']['tmp_name'], $fotoProfessor)){
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                        $erroUpload = true;
                    }

                }
                else{
                    echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
                    $erroUpload = true;
                }

                //Se não houver erro de preenchimento, exibe alerta de sucesso e uma tabela com os dados informados
                if(!$erroPreenchimento && !$erroUpload){

                    //Cria uma variável para armazenar a QUERY para realizar a inserção dos dados do Professor na tabela Professores
                    $inserirProfessor = "INSERT INTO Professores (fotoProfessor, nomeProfessor, descricaoProfessor, horarioProfessor, statusProfessor) VALUES ('$fotoProfessor', '$nomeProfessor', '$descricaoProfessor', '$horarioProfessor', 'disponivel')";

                    //Inclui o arquivo de conexão com o Banco de Dados
                    include("conexaoBD.php");

                    //Se conseguir executar a query para inserção, exibe alerta de sucesso e a tabela com os dados informados
                    if(mysqli_query($conn, $inserirProfessor)){

                        echo "<div class='alert alert-success text-center'><strong>Professor</strong> cadastrado(a) com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 text-center'>
                                    <img src='$fotoProfessor' style='width:150px;' title='Foto de $nomeProfessor'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>Nome</th>
                                        <td>$nomeProfessor</td>
                                    </tr>
                                    <tr>
                                        <th>Descrição Professor</th>
                                        <td>$descricaoProfessor</td>
                                    </tr>
                                    <tr>
                                        <th>Horario do Professor</th>
                                        <td>$horarioProfessor</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                        mysqli_close($conn); //Essa função encerra a conexão com o Banco de Dados
                    }
                    else{
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar <strong>Professor</strong> no Banco de Dados $database!</div>" . mysqli_error($conn);
                    }
                }
            }
            else{
                //Redireciona o usuário para o formProfessor.php
                header("location:formProfessor.php");
            }

            //Função para filtrar entrada de dados
            function filtrar_entrada($dado){
                $dado = trim($dado); //Remove espaços desnecessários
                $dado = stripslashes($dado); //Remove barras invertidas
                $dado = htmlspecialchars($dado); // Converte caracteres especiais em entidades HTML

                //Retorna o dado após filtrado
                return($dado);
            }
        ?>

    </div>

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>