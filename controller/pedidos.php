<?php
    require_once '../DAO/Conexao.php';
    require_once '../DAO/PedidosDAO/PedidosGet.php';
    require_once '../DAO/PedidosDAO/PedidosPost.php';
    require_once '../DAO/PedidosDAO/PedidosPut.php';
    require_once '../DAO/PedidosDAO/PedidosPatch.php';
    require '../DAO/PedidosDAO/PedidosDelete.php';
    require '../Model/PedidosModel/Pedido.php';
    require '../Model/PedidosModel/RespostaPedido.php';
    require './pedidosUtils.php';
    $req = $_SERVER;
    $conexao = conectar();
    
    //echo $req["REQUEST_METHOD"];
     switch ($req["REQUEST_METHOD"]) {
         case 'GET':
            $pedidos = json_encode(pegar_pedidos($conexao));
            echo $pedidos;
             break;
         case 'POST':
             
             $u = receberDados();
             
             $resp = incluir_pedido($conexao, $u);
             
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
            $id_cliente = $dados->id_cliente;

            $u = receberDados();

            $resp = editar_pedido($conexao, $u, $id_cliente);

            $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('204', 'Atualizado com sucesso');
                } else {
                  $in = criarResposta('400', 'Não atualizado');
                }

            echo json_encode($in);
             break;
         case 'PATCH':

            $resp = editar_pedido_parcialmente($conexao);
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
            $resp = deletar_pedido($conexao, $id_pedido);
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