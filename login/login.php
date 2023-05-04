<?php 

    require_once '../index/classe.php';
    $u = new usuario();
    if(isset($_POST['login'])){
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);
        /*echo "login: ".$login.", senha: ".$senha;
        echo "";*/
        if(!empty($login) && !empty($senha)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3');
            //echo "msg: ".$msgs; 
            if($u->msg == ""){
                if($u->logar($login,$senha)){
                  header("location: ../index/index.php");
                }else{
                    echo "<script language='javascript' type='text/javascript'>alert('N�o foi possivel logar no sistema!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='login.html';</script>";
                }
            }else{ 
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='login.html';</script>";
        }
    }

?>