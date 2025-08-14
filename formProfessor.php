<?php include "header.php" ?>

<div class="container text-center mb-3 mt-3">
    
    <h2>Cadastrar Professor:</h2>
    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col-12">
                <form action="actionProfessor.php" method="POST" class="was-validated" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="file" class="form-control" id="fotoProfessor" name="fotoProfessor" required>
                        <label for="fotoProfessor">Foto</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="nomeProfessor" placeholder="Nome" name="nomeProfessor" required>
                        <label for="nomeProfessor">Nome do Professor</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <textarea class="form-control" id="descricaoProfessor" placeholder="Informe uma breve descrição sobre o Professor" name="descricaoProfessor" required></textarea>
                        <label for="descricaoProfessor">Descrição do Professor</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mt-3 mb-3">
                        <input type="text" class="form-control" id="horarioProfessor" placeholder="horario do Professor" name="horarioProfessor" required>
                        <label for="horarioProfessor">horario do Professor:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar Professor</button>
                </form>
            </div>
        </div>
    </div>
    <br>

</div>

<?php include "footer.php" ?>