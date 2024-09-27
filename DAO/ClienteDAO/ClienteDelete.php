<?php 
   

   function deletar_cliente($conexao, $id){

        $sql = "DELETE FROM Clientes WHERE id = $id;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar");


        fecharConexao($conexao);
        return $res;
   };

   
   
?>