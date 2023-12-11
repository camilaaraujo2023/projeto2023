<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'projeto_backend';
    $port = '3306';
try {
    $connection = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    //echo"Conexão realizada com sucesso";
} catch (PDOException $e) {
    echo "Erro de conexão com banco ". $e->getMessage();
}
///////AÇÕES DO BOTÃO ACESSAR ###################################
if (isset( $_POST['entrar'])) {
    //refatorar
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $perfil = $_POST['perfil'];

        $query = "select login,senha,profile from usuarios where login=:login";
        $result = $connection ->prepare($query);
        $result->bindParam(":login", $login, PDO::PARAM_STR);
        $result->execute();
        
            if ($result->rowCount() !=0) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $userProfile = $row['profile'];
               // Redirect based on the user's profile
               
               if ($userProfile == 'comum' && $perfil == 'master') {
                    $_SESSION['msg'] = "<p style='color:#ff0000'>Perfil MASTER não pode ser acessado por um usuário comum.</p>";
               }
               elseif ($userProfile == 'master' && $perfil == 'master') {
                    header("Location: 2fa.php"); // Replace with the master profile page
                    exit();
                } 
               elseif ($userProfile == 'master' && $perfil == 'comum' || $perfil == 'commom' ) {
                    header("Location: common_profile.php"); // Replace with the common profile page
                    exit();
                }
               elseif ($userProfile == 'comum' && $perfil == 'comum' || $perfil == 'commom') {
                    header("Location: common_profile.php"); // Replace with the common profile page
                    exit();
                }
               else {
                    $_SESSION['msg'] = "<p style='color:#ff0000'>Usuário não encontrado.</p>";
                    //echo"Usuário logado com sucesso.";
                }
            }
//     if ($login=="") {
//     //$_SESSION['msg'] = "<p style='font: size 23px;px'> PREENCHA OS DADOS CORRETAMENTE.</p>" .$login;
// //die(" PREENCHA OS DADOS CORRETAMENTE");


//     }
    // else{
    //     $query = "select login,senha,profile from usuarios where login=:login";
    //     $result = $connection ->prepare($query);
    //     $result->bindParam(":login", $login, PDO::PARAM_STR);
    //     $result->execute();
        
    //         if ($result->rowCount() !=0) {
    //             $row = $result->fetch(PDO::FETCH_ASSOC);
    //            // echo"Usuário logado com sucesso.";
    //            $_SESSION['msg'] = "<p style='color:#00FF00 '>USUÁRIO LOGADO COM SUCESSO.</p>";
    //            // Retrieve the user's profile type
    //            $userProfile = $row['profile'];
    //            // Redirect based on the user's profile
    //            if ($userProfile === 'master') {
    //                 header("Location: master_profile.php"); // Replace with the master profile page
    //                 exit();
    //             } 
    //             else {
    //                 header("Location: common_profile.php"); // Replace with the common profile page
    //                 exit();
    //             }
    //         }else {
    //             $_SESSION['msg'] = "<p style='color:#ff0000'>Usuário não encontrado.</p>";
    //             //echo"Usuário logado com sucesso.";
    //         }
    // }
}
///////AÇÕES DO BOTÃO CADASTRAR ###################################
    if (isset( $_POST['cadastrar'])) {
        //refatorar
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $nome = $_POST['nome'];
            $nomeMaterno = $_POST['nomeMaterno'];
            $telefoneFixo = $_POST['telefone'];
            $data = $_POST['data'];
            $cpf = $_POST['cpf'];
            $celular = $_POST['celular'];
            $sexo = $_POST['sexo'];
            $endereco = $_POST['endereco'];
            $profile = $_POST['perfil'];
        
            if ($login=="" or $senha== "" or $nomeMaterno=="" or $telefoneFixo=="" or $data=="" or $cpf=="" or $celular=="" or $sexo== "" or $endereco== "" or $profile== "") {
                $_SESSION['msg'] = "<p style='font: size 23px;px'> PREENCHA OS DADOS CORRETAMENTE.</p>";
            //die(" PREENCHA OS DADOS CORRETAMENTE");
            
            
            }else{
    
                    $query = "insert into usuarios(login,senha,nome,nomeMaterno,telefoneFixo,dataNascimento,cpf,celular,sexo,endereco,profile) values(:login,:senha,:nome,:nomeMaterno,:telefone,:data,:cpf,:celular,:sexo,:endereco,:profile)";
                    $result = $connection ->prepare($query);
                    $result->bindParam(":login", $login, PDO::PARAM_STR);
                    $result->bindParam(":senha", $senha, PDO::PARAM_STR);
                    $result->bindParam(":nome", $nome, PDO::PARAM_STR);
                    $result->bindParam(":nomeMaterno", $nomeMaterno, PDO::PARAM_STR);
                    $result->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                    $result->bindParam(":data", $data, PDO::PARAM_STR);
                    $result->bindParam(":cpf", $cpf, PDO::PARAM_STR);
                    $result->bindParam(":celular", $celular, PDO::PARAM_STR);
                    $result->bindParam(":sexo", $sexo, PDO::PARAM_STR);
                    $result->bindParam(":endereco", $endereco, PDO::PARAM_STR);
                    $result->bindParam(":profile", $profile, PDO::PARAM_STR);
                    $result->execute();
                     
                if ($result->rowCount() !=0) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                   $_SESSION['msg'] = "<p style='color:#00FF00 '>USUÁRIO CADASTRADO COM SUCESSO.</p>";
                }else {
                    $_SESSION['msg'] = "<p style='color:#ff0000'>PROBLEMA AO CADASTRAR USUÁRIO.</p>";
    
                }

            }  
        }

///////BOTÃO PREENCHETR TABELA  ###################################
 if (isset( $_POST['exibir'])) {
            //refatorar
                        
      $query = "select * from usuarios";
      $result = $connection ->prepare($query);
      $result->execute();
                       
                        echo "<strong>Lista de Usuários</strong>:";
		                 echo "<br />";
		                 echo "<br />";
                        
                        



                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        // echo "<strong>Id</strong>:" .$row['id'] ;
			            // echo " - ";
                        // echo "<strong>Login</strong>:" .$row['login'] ;
			            // echo " - ";
			            // echo "<strong>senha</strong>: ".$row['senha'];
			            // echo "<br />";

                                                
                        // laço de repetição para inclusão dos dados na tabela
                        $table  = '<table>';
                        $table .= '<thead>';
                        $table .= '<tr>';
                        $table .= '<td>ID</td>';
                        $table .= '<td>Login</td>';
                        $table .= '<td>Senha</td>';
                        $table .= '</tr>';
                        $table .= '</thead>';
                        $table .= '<tbody>';
                            $table .= '<tr>';
                                $table .= "<td>{$row['id']}</td>";
                                $table .= "<td>{$row['login']}</td>";
                                $table .= "<td>{$row['senha']}</td>";
                            $table .= '</tr>';
                               
                               // fecahamento do html
                               $table .= '</tbody>';
                               $table .= '</table>';
                               
                               // exibição na tela
                               echo $table;
                            }
                      
                        
                        
}
 
    
?>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }

?>