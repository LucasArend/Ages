<?php 
    error_reporting(0);
    require_once '../index/classe.php';
    $u = new usuario();
    if(isset($_POST['nomeguerra'])){
        $companhia = addslashes($_POST['companhia']);
        $posto = addslashes($_POST['posto']);
        $numero = addslashes($_POST['numero']);
        $nomeguerra = addslashes($_POST['nomeguerra']);
        $situacao = addslashes($_POST['situacao']);
        echo "$msg";
        if(!empty($companhia) && !empty($posto) && !empty($numero) && !empty($nomeguerra)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
            echo "$msg";
            if($u->msg == ""){
                if($u->cadastrar_militar($companhia,$posto,$numero,$nomeguerra,$situacao)){
                    echo "<script language='javascript' type='text/javascript'>alert('O militar foi cadastrado com sucesso!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='index.php'</script>";
                }else{
                    echo "<script language='javascript' type='text/javascript'>alert('O militar já está cadastrado no sistema. Tente outro!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='cadastro.php';</script>";
                }
            }else{
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='cadastro.php';</script>";
        }
    }

?>