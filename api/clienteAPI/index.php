<?php

  /*
  * $request -> Recebe dados do corpo da requisição (JSON, FORM/DATA, XML, etc)
  * $response -> Envia dados de retorno da API
  * $args -> Permite receber dados de atributos na API
  *
  * Os metodos de reposição para uma API RESTful são:
  * GET       - para buscar dados
  * POST      - para iserir um novo dado
  * DELETE    - para apagar dados
  * PUT/PATCH - para editar um dado já existente
  *             o mais utilizado é o PUT
  *
  * 
  */

  //import do arquivo autoload, que fará as instancias do slim
  var_dump($_GET['url']);
  die;

  require_once('vendor/autoload.php');  

  //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
  $app = new \Slim\App();

  //Endpoint Requisiçã para inserir um novo contato
  $app->post('/cliente', function($request, $response, $args){
    
    //Recebe do header da requisição qual será o content type
    $contentTypeHeader = $request->getHeaderLine('Content-Type');
    //Cria um array ois dependendo do content-type temos mais informações separadas
    $contentType = explode(';', $contentTypeHeader);

    
    echo ($contentTypeHeader);
   

    switch ($contentType[0]) {
      case 'application/json':

        //Recebe os dados enviado pelo corpo da requisição
        $dadosBody = $request->getParsedBody();   
      
      //import da controller de contatos, que fará a busca de dados
      require_once('../modulo/config.php');
      require_once('../controller/controllerClientes.php');
      
      $resposta = inserirCliente($dadosBody);

      if (is_bool($resposta) && $resposta == true) {

        return $response   ->withStatus(201)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message":"Contato inserido com sucesso"}');

      } elseif (is_array($resposta) && $resposta['idErro'])        
      {
        $dadosJSON = createJSON($resposta);

        return $response   ->withStatus(400)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message":"Erro ao inserir contato."},
                            "Erro": '.$dadosJSON.' }');
      }     
        
        break;     
      
    }

  });

  //Executa todos os Endpoint
  $app->run();
  



?>