<?php
function deletar_pedido($conexao, $id) {
  // exclua os produtos associados aos pedidos
  $sqlDeleteProdutos = "DELETE FROM pedidos_produtos WHERE id_pedido IN (SELECT id_pedido FROM Pedidos WHERE id_cliente = $id);";
  mysqli_query($conexao, $sqlDeleteProdutos);
  // exclua os pedidos associados ao cliente
  $sqlDeletePedidos = "DELETE FROM Pedidos WHERE id_cliente = $id;";
  mysqli_query($conexao, $sqlDeletePedidos);
  // exclua o cliente
  $sql = "DELETE FROM Pedidos WHERE id_cliente = $id;";
  $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar pedidos: " . mysqli_error($conexao));
  fecharConexao($conexao);
  return $res;
}

?>