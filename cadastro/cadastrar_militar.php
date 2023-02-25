<?php 

    require_once '../index/classe.php';
    $u = new usuario();
    if(isset($_POST['nomeguerra'])){
        $nomeguerra = addslashes($_POST['nomeguerra']);
        $numero = addslashes($_POST['numero']);
        $companhia = addslashes($_POST['companhia']);
        $posto = addslashes($_POST['posto']);
        if(!empty($nomeguerra) && !empty($numero) && !empty($companhia) && !empty($posto)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
            echo "$msg";
            if($u->msg == ""){
                if($u->cadastrar_militar($nomeguerra,$numero,$companhia, $posto,0,0)){
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../cadastro/gerenciar_militar.php'</script>";
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario já está cadastrado no sistema. Tente outro!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='cadastro.html';</script>";
                }
            }else{
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='cadastro.html';</script>";
        }
    }

?>