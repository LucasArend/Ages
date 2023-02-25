<?php 

    require_once '../index/classe.php';
    $u = new usuario();
    $id_escala = addslashes($_POST['id_escala']);
    if($_POST['id_militar']!='NULL'){
        $id_militar = addslashes($_POST['id_militar']);
        $folgap = addslashes($_POST['folgap']);
        $folgav = addslashes($_POST['folgav']);
        if(empty($folgap)){
        $folgap = 0;
        }
        if(empty($folgav)){
        $folgav = 0;
        }
        if(!empty($id_escala)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
            if($u->msg == ""){
                if($u->add_mil_prev($id_escala,$id_militar,$folgap, $folgav)){
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../escala/editar_escala.php?id=$id_escala'</script>";
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>alert('O usuario já está cadastrado no sistema. Tente outro!')</script>";
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../escala/editar_escala.php?id=$id_escala';</script>";
                }
            }else{
                echo "Erro: ".$u->msg;
            }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Preenha todos os campos!')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='cadastro.html';</script>";
        }
    }else {
            echo "<script language='javascript' type='text/javascript'>alert('Selecione um militar')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='../escala/editar_escala.php?id=$id_escala';</script>";
    }

?>