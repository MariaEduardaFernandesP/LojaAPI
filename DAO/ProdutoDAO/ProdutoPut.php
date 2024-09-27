<?php 
   
   function editar_produto($conexao, $u, $id){

        $sql = "UPDATE Produtos SET nome = '$u->nome', descricao = '$u->descricao', qtd = '$u->qtd', marca = '$u->marca', preco ='$u->preco', validade = '$u->validade' WHERE id = $id;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar incluir");
        fecharConexao($conexao);
        return $res;
   };

?>