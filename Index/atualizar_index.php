 <?php
require_once '../index/classe.php';

$u = new usuario();
$u->conectar('ages','localhost','ages','dna,Pncadm3');
$excluir_escala=filter_input_array(INPUT_POST, FILTER_DEFAULT);
foreach($excluir_escala as $aux => $valor) {
	if ($aux == 'excluir'){
		foreach($excluir_escala['excluir'] as $remover => $valor){
			echo $aux;
			$query_excluir = "DELETE FROM escala WHERE id_escala=:id_prev";
			$up_excluir = $pdo->prepare($query_excluir);
			$up_excluir->bindValue('id_prev', $remover, PDO::PARAM_INT);
			$up_excluir->execute();
		}
	}
}
echo "<script language='javascript' type='text/javascript'>alert('Escala foi excluida com sucesso!')</script>";
echo "<script language='javascript' type='text/javascript'>window.location.href='../index/index.php'</script>";