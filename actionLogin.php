<?php

    session_start(); //função para inciar uma sessão
    include("conexaoBD.php");

    $emailUsuario = mysqli_real_escape_string($link, $_POST["emailUsuario"]);
    $senhaUsuario = mysqli_real_escape_string($link, $_POST["senhaUsuario"]);


    $buscarLogin ="SELECT *
                   FROM usuarios 
                    WHERE email = '$emailUsuario'
                    AND senha = md5('$senhaUsuario')
                    ";

    
    $efetuarLogin = mysqli_query($link, $buscarLogin);
    
    if($registro = mysqli_fetch_assoc($efetuarLogin)){
        $quantidadeLogin = mysqli_num_rows($efetuarLogin);
  
        $emaiUsuario = $registro["email"];
        $nomeUsuario = $registro["nome"];


        $_SESSION["emaiUsuario"] = $emaiUsuario;
        $_SESSION["nomeUsuario"] = $nomeUsuario;

        header("location:index.php"); //Funçao que rediereciona para uma determinada pagina


        //echo "<h1>Foram encontrados $quantidadeLogin com os dados informados!</h1>";

    }
    else{
        echo"<h1>Não existe login para os dados informados! </h1>";
        header("location:FormLogin.php?erroLogin='dadosInvalidos'");
    }
?>