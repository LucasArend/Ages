 <?php
require_once '../index/classe.php';

$u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3');
$previsao_escala=filter_input_array(INPUT_POST, FILTER_DEFAULT);
$ancora = reset($previsao_escala['escala_prev']);
foreach($previsao_escala['id_prev'] as $aux => $valor) {
	foreach($previsao_escala as $previsao => $array){
		if ($previsao != 'id_prev' && $previsao != 'excluir' ){
			$query_previsao = "UPDATE previsao SET $previsao=:valor WHERE id_previsao=:id_prev";
			$up_previsao = $pdo->prepare($query_previsao);
			#$up_militar->bindParam('var', $previsao, PDO::PARAM_STR);
			$up_previsao->bindValue('valor', $previsao_escala[$previsao][$aux], PDO::PARAM_STR);
			$up_previsao->bindParam('id_prev', $previsao_escala['id_prev'][$aux], PDO::PARAM_INT);
			$up_previsao->execute();
		}
		elseif ($previsao == 'excluir'){
			foreach($previsao_escala['excluir'] as $remover => $valor){
			$query_excluir = "DELETE FROM previsao WHERE id_previsao=:id_prev";
			$up_excluir = $pdo->prepare($query_excluir);
			$up_excluir->bindValue('id_prev', $remover, PDO::PARAM_INT);
			$up_excluir->execute();
			}
		}
	}
}
echo "<script language='javascript' type='text/javascript'>alert('Usuarios foram atualizados!')</script>";
echo "<script language='javascript' type='text/javascript'>window.location.href='../escala/editar_escala.php?id=$ancora'</script>";