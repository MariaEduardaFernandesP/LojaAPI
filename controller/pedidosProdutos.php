<?php
    require_once '../DAO/Conexao.php';
    require_once '../DAO/PedidosProdutosDAO/PedidosProdutosGet.php';
    require_once '../DAO/PedidosProdutosDAO/PedidosProdutosPost.php';
    require_once '../DAO/PedidosProdutosDAO/PedidosProdutosPut.php';
    require_once '../DAO/PedidosProdutosDAO/PedidosProdutosPatch.php';
    require '../DAO/PedidosProdutosDAO/PedidosProdutosDelete.php';
    require '../Model/PedidosProdutosModel/PedidosProdutos.php';
    require '../Model/PedidosProdutosModel/RespostaPedidosProdutos.php';
    require './pedidosProdutosUtils.php';
    $req = $_SERVER;
    $conexao = conectar();
    
    //echo $req["REQUEST_METHOD"];
     switch ($req["REQUEST_METHOD"]) {
         case 'GET':
            $pedidosProdutos = json_encode(pegar_pedidosProdutos($conexao));
            echo $pedidosProdutos;
             break;
         case 'POST':
             
             $u = receberDados();
             
             $resp = incluir_pedidoProduto($conexao, $u);
             
             $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('200', 'Incluso com sucesso');
                } else {
                  $in = criarResposta('400', 'não incluso');
                }
             
             echo json_encode($in);
          
             break;
         case 'PUT':
            $dados = json_decode(file_get_contents('php://input'));
            $id_produto = $dados->id_produto;

            $u = receberDados();

            $resp = editar_pedidoProduto($conexao, $u, $id_produto);

            $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('204', 'Atualizado com sucesso');
                } else {
                  $in = criarResposta('400', 'Não atualizado');
                }

            echo json_encode($in);
             break;
         case 'PATCH':

            $resp = editar_pedidoProduto_parcialmente($conexao);
            $resposta = new Resposta('','');
            if($resp){
                $resposta = criarResposta('204', 'Atualizado com sucesso');
            } else{
               $resposta = criarResposta('400', 'Não atualizado');
            }
            echo 'Atualizado com Sucesso';
             break;
         case 'DELETE':
            $dados = json_decode(file_get_contents('php://input'));
            $id_pedido = $dados->id_pedido;
           // echo $id;
            $resp = deletar_pedidoProduto($conexao, $id_pedido);
            $resposta = new Resposta('', '');
            if($resp){
                $resposta = criarResposta('204', 'Excluido com suceso');
            } else {
                $resposta = criarResposta('400', 'Não excluido');
            }
             echo json_encode($resposta);
             break;          
         default:
             # code...
             break;
     }





?>