<?php

//Verificação de condicional para a requisição GET e parâmetro page na URL
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page'])) {

    //Criada variável $page para salvar o parâmetro passado na URL
    $page = $_GET['page'];
    $limitePorPagina = 15;
    $totalItens = 150;

    //Criada variável $offset que armazena o parâmetro para a paginação da requisição URL
    $offset = ($page - 1) * $limitePorPagina;

    //Criada variável $pokemonTxt para armazenar os dados do arquivo Txt
    $pokemonTxt = 'pokemon.txt';

    //Condicional que verifica a paginação até 10
    if($page <=10) {

        //Condicional que verifica se o arquivo Txt não existe
        if(!file_exists($pokemonTxt)) {

            //Criada variável $apiGet que armazena a URL e seus parâmetros
            $apiGet = 'https://pokeapi.co/api/v2/pokemon?offset=0&limit=' . $totalItens;

            //Criada variável $retornoApi que lê e armazena os dados da URL em string json
            $retornoApi = file_get_contents($apiGet);

            //Gravação dos dados retornados da Api em arquivo Txt
            file_put_contents($pokemonTxt, $retornoApi);

        //Caso o arquivo Txt exista
        } else {
            //Criada variável que decodifica a string json do Txt para um array associativo
            $pokemonData = json_decode(file_get_contents($pokemonTxt), true);

            //Criada variável que armazena o corta do array conforme os parâmetros da paginação
            $dadosPaginados = array_slice($pokemonData['results'], $offset, $limitePorPagina);

            //Atualização da variável $pokemonData com os dados paginados
            $pokemonData['results'] = $dadosPaginados;

            //Criada variável $retornoApi que armazena os dados de $pokemonData em formato string json
            $retornoApi = json_encode($pokemonData);
        }

        //Indicação do conteúdo em formato json e impressão da Api ou do arquivo Txt
        header('Content-Type: application/json');
        echo $retornoApi;
    
    //Retorno de erro no caso da paginação maior que 10
    } else {
        header('HTTP 400 (Bad Request');
        echo "Paginação fora do parâmetro.";
    }

//Retorno de erro no caso da requisição não ser GET e não conter o parâmetro 'page' na URL passada
} else {
    header('HTTP 400 (Bad Request');
    echo "Erro na requisição.";
}


/* - Iniciar o servidor com php -S localhost:8100
- No navegador colocar o endereço http://localhost:8100/api_pokemon.php/pokemon?page=1
- Endereço API pokemon - https://pokeapi.co/api/v2/pokemon/
*/