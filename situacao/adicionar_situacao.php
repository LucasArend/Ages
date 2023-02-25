<?php 

    require_once '../index/classe.php';
    $u = new usuario();
    if(!empty($_POST['IDmilitar'])){
        $id_militar = addslashes($_POST['IDmilitar']);
        $motivo = addslashes($_POST['motivo']);
        $data_inicio = addslashes($_POST['data_inicio']);
        $data_fim = addslashes($_POST['data_fim']);
        $ativo = addslashes($_POST['ativo']);
        if(!empty($id_militar)){
            $u->conectar('ages','localhost','ages','dna,Pncadm3'); 
                if($u->add_situacao($id_militar,$motivo,$data_inicio, $data_fim, $ativo)){
                    echo "<script language='javascript' type='text/javascript'>window.location.href='../situacao/editar_situacao.php?id=$id_militar'</script>";
                }
        }else {
            echo "<script language='javascript' type='text/javascript'>alert('Algo deu errado, tente novamente')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='../situacao/editar_situacao.php?id=$id_militar';</script>";
        }
    }else {
            echo "<script language='javascript' type='text/javascript'>alert('Selecione um militar')</script>";
            echo "<script language='javascript' type='text/javascript'>window.location.href='../situacao/editar_situacao.php?id=$id_militar';</script>";
    }

?>