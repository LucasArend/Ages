<?php 

    require_once '../index/classe.php';
    $u = new usuario();
    if(isset($_POST['login'])){
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);
        $nivel = addslashes($_POST['nivel']);
        $cia = addslashes($_POST['cia']);
        echo "$msg";
        if(!empty($login) && !empty($senha) && !empty($nivel)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
            echo "$msg";
            if($u->msg == ""){
                if($u->cadastrar($login,$senha,$nivel,$cia)){
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario foi cadastrado com sucesso!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../index/index.php'</script>";
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario já está cadastrado no sistema. Tente outro!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../cadastro/cadastrar.php';</script>";
                }
            }else{
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='../cadastro/cadastrar.php';</script>";
        }
    }

?>