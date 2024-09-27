<?php
    require_once '../DAO/Conexao.php';
    require_once '../DAO/ProdutoDAO/ProdutoGet.php';
    require_once '../DAO/ProdutoDAO/ProdutoPost.php';
    require_once '../DAO/ProdutoDAO/ProdutoPut.php';
    require_once '../DAO/ProdutoDAO/ProdutoPatch.php';
    require '../DAO/ProdutoDAO/ProdutoDelete.php';
    require '../Model/ProdutoModel/Produto.php';
    require '../Model/ProdutoModel/RespostaProduto.php';
    require './produtoUtils.php';
    $req = $_SERVER;
    $conexao = conectar();
    
    //echo $req["REQUEST_METHOD"];
     switch ($req["REQUEST_METHOD"]) {
         case 'GET':
            $produtos = json_encode(pegar_produtos($conexao));
            echo $produtos;
             break;
         case 'POST':
             
             $u = receberDados();
             
             $resp = incluir_produto($conexao, $u);
             
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
            $id = $dados->id;

            $u = receberDados();

            $resp = editar_produto($conexao, $u, $id);

            $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('204', 'Atualizado com sucesso');
                } else {
                  $in = criarResposta('400', 'Não atualizado');
                }

            echo json_encode($in);
             break;
         case 'PATCH':

            $resp = editar_produto_parcialmente($conexao);
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
            $id = $dados->id;
           // echo $id;
            $resp = deletar_produto($conexao, $id);
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