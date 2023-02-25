 <?php
require_once '../index/classe.php';
$u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3');
$militares=filter_input_array(INPUT_POST, FILTER_DEFAULT);
foreach($militares['id_militares'] as $aux => $valor) {
	 foreach($militares as $militar => $array){
		if ($militar != 'id_militares' && $militar != 'excluir'){
			$query_militar= "UPDATE militares SET $militar=:valor WHERE ID=:id_militares";
			$up_militar = $pdo->prepare($query_militar);
			#$up_militar->bindParam('var', $militar, PDO::PARAM_STR);
			$up_militar->bindValue('valor', $militares[$militar][$aux], PDO::PARAM_STR);
			$up_militar->bindParam('id_militares', $militares['id_militares'][$aux], PDO::PARAM_INT);
			$up_militar->execute();
		}
		elseif ($militar == 'excluir'){
			foreach($militares['excluir'] as $remover => $valor){
			$query_excluir = "DELETE FROM militares WHERE ID=:id_mil";
			$up_excluir = $pdo->prepare($query_excluir);
			$up_excluir->bindValue('id_mil', $remover, PDO::PARAM_INT);
			$up_excluir->execute();
			}
		}
	}
}
echo "<script language='javascript' type='text/javascript'>alert('Usuarios foram atualizados!')</script>";
echo "<script language='javascript' type='text/javascript'>window.location.href='../cadastro/gerenciar_militar.php'</script>";