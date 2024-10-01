<?php
        function criarResposta($status, $msg){
           $resp = new Resposta($status, $msg);
           return $resp;
        }
        function receberDados(){
           $dados = json_decode(file_get_contents('php://input'));
           $id_pedido = $dados->id_pedido;
           $id_produto = $dados->id_produto;
           $qtd = $dados->qtd;
           $dadospedidosProdutos = new PedidoProduto( $id_pedido, $id_produto, $qtd );
           return $dadospedidosProdutos;
       }
?>