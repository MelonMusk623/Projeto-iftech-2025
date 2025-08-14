<?php include "header.php" ?>

<div class='container mt-3 mb-3'>

    <div class='row'>

        <!-- Coluna para exibir o select para listar Usuários -->
        <div class='col-sm-6'>
            <div class='form-floating mt-3 mb-3'>
                <select class='form-select' name='nomeUsuario'>
                    <?php
                        include "conexaoBD.php";
                        $listarUsuarios = "SELECT * FROM Usuarios";
                        $res = mysqli_query($conn, $listarUsuarios) or die ("Erro ao tentar carregar Usuários!");
                        while($registro = mysqli_fetch_assoc($res)){
                            $idUsuario   = $registro['idUsuario'];
                            $nomeUsuario = $registro['nomeUsuario'];
                            echo "<option value='$idUsuario'>$nomeUsuario</option>";
                        }
                    ?>
                </select>
                <label for='nomeUsuario'>Selecione um Usuário</label>
            </div>
        </div>

        <!-- Coluna para exibir o select para listar Professores -->
        <div class='col-sm-6'>
            <div class='form-floating mt-3 mb-3'>
                <select class='form-select' name='nomeProfessor'>
                    <?php
                        include "conexaoBD.php";
                        $listarProfessores = "SELECT * FROM Professores";
                        $res = mysqli_query($conn, $listarProfessores) or die ("Erro ao tentar carregar Professores!");
                        while($registro = mysqli_fetch_assoc($res)){
                            $idProfessor   = $registro['idProfessor'];
                            $nomeProfessor = $registro['nomeProfessor'];
                            echo "<option value='$idProfessor'>$nomeProfessor</option>";
                        }
                    ?>
                </select>
                <label for='nomeProfessor'>Selecione um Professor</label>
            </div>
        </div>

    </div>

</div>

<?php include "footer.php" ?>