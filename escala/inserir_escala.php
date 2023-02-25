<?php 
    session_start();
    require_once '../index/classe.php';
    $u = new usuario();
    if(isset($_POST['servico'])){
        $ID = addslashes($_SESSION['ID']);
        $servico = addslashes($_POST['servico']);
        $descricao = addslashes($_POST['descricao']);
        $cia = addslashes($_SESSION['cia']);
        $quantia = addslashes($_SESSION['quantia']);
        if(empty($descricao)){
            $descricao = 'Sem descricao';
        }
        echo"Bem-Vindo " .$_SESSION['cia'];
        if(!empty($servico) && !empty($cia)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
            echo "$msg";
            if($u->msg == ""){
                if($u->inserir_escala($servico,$descricao, $cia, $ID, $quantia)){
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario foi cadastrado com sucesso!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../index/index.php'</script>";
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario já está cadastrado no sistema. Tente outro!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../index/index.php';</script>";
                }
            }else{
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='../index/index.php';</script>";
        }
    }

?>