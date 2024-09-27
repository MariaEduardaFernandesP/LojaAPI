<?php 
   

   function deletar_pedido($conexao, $id_pedido){

        $sql = "DELETE FROM Pedidos WHERE id_pedido = $id_pedido;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar");


        fecharConexao($conexao);
        return $res;
   };

   
   
?>

