<?php 
   

   function deletar_pedidoProduto($conexao, $id_pedido){

        $sql = "DELETE FROM pedidos_produtos WHERE id_pedido = $id_pedido;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar");


        fecharConexao($conexao);
        return $res;
   };

   
   
?>