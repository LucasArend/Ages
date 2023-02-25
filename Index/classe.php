<?php
header('Content-Type: text/html; charset=ISO-8859-1');


    Class Usuario{
            
        private $pdo;
        public $msg="";
    
        public function conectar($dbname,$host,$usuario,$senha){
            global $pdo;
            try {                
                $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $usuario, $senha);    
            }
            catch (PDOException $erro) {
                global $msg;
                $msg = $erro->getMessage();
            }
            
        }
        
        public function cadastrar($login,$senha,$nivel, $cia){
            global $pdo;
            $senhaMD5=MD5($senha);
            //  Verifica se já existe
            $sql = $pdo->prepare("SELECT ID FROM usuarios WHERE login = '$login'");
            $sql->execute();
            if($sql->rowCount() > 0){
                // já existe
                return false;
            }else{
                // não existe, cadastrar
                $sql = $pdo->prepare("INSERT INTO usuarios (login,senha,nivel,cia) VALUES ('$login','$senhaMD5','$nivel', '$cia')");
                $sql->execute();
                return true;
            }
            
        }

        public function inserir_escala($servico,$descricao, $cia, $ID, $quantia){
            global $pdo;
            //  Verifica se já existe
            $sql = $pdo->prepare("SELECT id_escala FROM escala WHERE servico = '$servico' AND cia = '$cia'");
            $sql->execute();
            if($sql->rowCount() > 0){
                // já existe
                return false;
            }else{
                // não existe, cadastrar
                $sql = $pdo->prepare("INSERT INTO escala (servico,descricao, cia, usuario_escala, quantia) VALUES ('$servico','$descricao', '$cia', '$ID', '$quantia')");
                $sql->execute();
                return true;
            }
            
        }

        public function cadastrar_militar ($nomeguerra,$numero,$companhia,$posto){
            global $pdo;
            //  Verifica se já existe
            $sql = $pdo->prepare("SELECT ID FROM militares WHERE nomeguerra = '$nomeguerra' AND numero = '$numero'");
            $sql->execute();
            if($sql->rowCount() > 0){
                // já existe
                return false;
            }else{
                // não existe, cadastrar
                $sql = $pdo->prepare("INSERT INTO militares (companhia,posto,numero,nomeguerra) VALUES ('$companhia','$posto','$numero','$nomeguerra')");
                $sql->execute();
                return true;
            }
            
        }


        public function logar($login,$senha){
            global $pdo;
            $senhaMD5=MD5($senha);
            // //  Verifica se está cadastrado
            $sql = $pdo->prepare("SELECT ID, login, nivel, cia FROM usuarios WHERE login = '$login' AND senha = '$senhaMD5'");
            $sql->execute();
            if($sql->rowCount() > 0){
                // está cadastrado
                $dado = $sql -> fetch();
                session_start();
                $_SESSION['ID'] = $dado['ID'];
                $_SESSION['login'] = $dado['login'];
                $_SESSION['nivel'] = $dado['nivel'];
                $_SESSION['cia'] = $dado['cia'];
                return true;
            }else{
                // não está cadastrado
                return false;
            }
        }
        
        public function imprimir(){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM militares");
            $sql->execute();
            if ($sql->rowCount() > 0) {
               while ( $row = $sql->fetch()){
                        echo '<tr>';
                        echo '<td>'. $row['companhia'] .'</td>';
                        echo '<td>'. $row['posto'] .'</td>';
                        echo '<td>'. $row['nomeguerra'] .'</td>';
                        echo '<td>'. $row['numero'] .'</td>';
                        if($row['situacao'] != NULL){
                            $row['situacao'] = 'Fora da escala';
                        }
                        echo '<td>'. $row['situacao'] .'</td>';
                        echo '</tr>';
               }
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }
        }

        public function imprimir_escala(){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM escala");
            $sql->execute();
            if ($sql->rowCount() > 0) {
               while ( $row = $sql->fetch()){
                        extract($row);
                        echo "<tr>";
                        echo "<td>$servico</td>";
                        echo "<td>$descricao</td>";
                        echo "<td>$folga_preta</td>";
                        echo "<td>$folga_vermelha</td>";
                        echo "<td>$ativos</td>";
                        echo "<td>$cia</td>";
                        echo "<td><a href='../escala/ver_escala.php?id=$id_escala'> ver </a></td>";
                        echo "</tr>";
                        
               }
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }
        }

        public function imprimir_previsao($id){
            global $pdo;
            $sql = $pdo->prepare("SELECT dia, nomeguerra , servico, quantia, trocas
                                  FROM previsao
                                  JOIN escala ON previsao.escala_prev = escala.id_escala
                                  JOIN militares ON militar_prev = militares.ID
                                  WHERE `id_escala` = $id
                                  ORDER BY dia;");
            $sql->execute();
            if ($sql->rowCount() > 0) {
               while ( $row = $sql->fetch()){
                        extract($row);
                        echo " 

                        <p ><h2 class='text-center'>$servico </h2></p>
                        <table border='1'>
                        <tr>
                            </tr>
                            <tr>
                                    <th>Dia</th>
                                    <td>$dia</td>
                            </tr>
                            <tr>
                                <th>Militar de SV</th>
                                <td>$nomeguerra</td>
                            </tr>
                            <tr>
                                <th>Trocas</th>
                                <td>$trocas</td>
                            </tr>
                        </tr>
                        </table>
                        ";             
               }
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }
        }
        public function add_mil_prev($id_escala,$id_militar,$folgap, $folgav){
            global $pdo;
            //  Verifica se já existe
            $sql = $pdo->prepare("SELECT militar_prev FROM previsao WHERE militar_prev = '$id_militar' AND escala_prev = '$id_escala'");
            $sql->execute();
            if($sql->rowCount() > 0){
                // já existe
                return false;
            }else{
                // não existe, cadastrar
                $sql = $pdo->prepare("INSERT INTO previsao (escala_prev,militar_prev,folga_preta,folga_vermelha) VALUES ('$id_escala','$id_militar','$folgap','$folgav')");
                $sql->execute();
                return true;
            }

        }

        public function add_situacao($id_militar,$motivo,$data_inicio, $data_fim, $ativo){
            global $pdo;
                // não existe, cadastrar
                $sql = $pdo->prepare("INSERT INTO situacao (IDmilitar,motivo,data_inicio,data_fim,ativo) VALUES ('$id_militar','$motivo','$data_inicio','$data_fim','$ativo')");
                $sql->execute();
                return true;

        }

        public function imprimir_situacao(){
            global $pdo;
            $sql = $pdo->prepare("SELECT DISTINCT  * FROM `militares` LEFT JOIN situacao ON militares.ID = situacao.IDmilitar GROUP BY ID ORDER BY ID;");
            $sql->execute();
            if ($sql->rowCount() > 0) {
               while ( $row = $sql->fetch()){
               extract($row);
                        echo '<tr>';
                        echo '<td>'. $row['companhia'] .'</td>';
                        echo '<td>'. $row['posto'] .'</td>';
                        echo '<td>'. $row['nomeguerra'] .'</td>';
                        echo '<td>'. $row['numero'] .'</td>';
                        
                if ($row['ativo'] == 0) {
                $row['ativo'] = "Nao";
                }
                else {
                $row['ativo'] = "Sim";
	            }
                echo '<td>' . $row['ativo'] .' </td>';
                echo "<td><a href='../situacao/editar_situacao.php?id=$ID'> ver </a></td>";
                echo '</tr>';

            }
            }else{
                echo '<td>Nenhum usuario cadastrado</td>';
            }
        }
    }

?>