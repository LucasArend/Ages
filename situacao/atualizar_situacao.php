 <?php
require_once '../index/classe.php';

$u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3');
$situacao=filter_input_array(INPUT_POST, FILTER_DEFAULT);
$ancora = reset($situacao['IDmilitar']);
echo '<pre>'; print_r($situacao); echo '</pre>';
foreach($situacao['id_situacao'] as $aux => $valor) {
	foreach($situacao as $situacao_array => $array){
		if ($situacao_array != 'id_situacao' && $situacao_array != 'excluir' ){
			$query_situacao_array = "UPDATE situacao SET $situacao_array=:valor WHERE id_situacao=:id_situacao";
			$up_situacao_array = $pdo->prepare($query_situacao_array);
			#$up_militar->bindParam('var', $situacao_array, PDO::PARAM_STR);
			$up_situacao_array->bindValue('valor', $situacao[$situacao_array][$aux], PDO::PARAM_STR);
			$up_situacao_array->bindParam('id_situacao', $situacao['id_situacao'][$aux], PDO::PARAM_INT);
			$up_situacao_array->execute();
		}
		elseif ($situacao_array == 'excluir'){
			foreach($situacao['excluir'] as $remover => $valor){
			$query_excluir = "DELETE FROM situacao WHERE id_situacao=:id_situacao";
			$up_excluir = $pdo->prepare($query_excluir);
			$up_excluir->bindValue('id_situacao', $remover, PDO::PARAM_INT);
			$up_excluir->execute();
			}
		}
	}
}
echo "<script language='javascript' type='text/javascript'>alert('Usuarios foram atualizados!')</script>";
echo "<script language='javascript' type='text/javascript'>window.location.href='../situacao/editar_situacao.php?id=$ancora'</script>";