<?php
include('conexao.php');
if (isset($_POST['usuario']) || isset($_POST['senha'])){
     $usuario=$mysqli->real_escape_string($_POST['usuario']);
     $senha=$mysqli->real_escape_string($_POST['senha']);
     $sql_code="SELECT * from usuarios WHERE usuario='$usuario' AND senha='$senha'";
     $sql_query=$mysqli->query($sql_code)or die("falha na conexao do codigo sql:" .$mysqli->error);
     $quantidade=$sql_query->num_rows;
     if($quantidade==1){
        $usuario=$sql_query->fetch_assoc();
        if(!isset($_SESSION)){
            session_start();
        }
$_SESSION['user']=$usuario['id'];

header("location:bemvindo.php");


}else{
    echo"falha ao logar! usuario ou senha incorretas";
}
}
?>
