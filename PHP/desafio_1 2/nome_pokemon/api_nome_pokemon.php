<?php

//Verificação de condicional para a requisição GET e parâmetro page na URL
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {

    //Criada variável $nome para salvar o parâmetro passado na URL
    $nome = $_GET['name'];

    //Criada variável para salvar os dados do Txt com o nome passado no parâmetro da URL
    $nomePokemon = $nome . '.txt';

    //Condicional para verificar se o arquivo Txt existe
    if (file_exists($nomePokemon)) {

        //Criada variável que armazena os dados do Txt lido e decodificado de string json para array
        $pokemonData = json_decode(file_get_contents($nomePokemon), true);

        //Indicação do conteúdo em formato json e impressão da Api ou do arquivo Txt
        header('Content-Type: application/json');
        echo json_encode($pokemonData);
    
    //Caso o arquivo Txt não exista
    } else {

        //Criada variável que armazena a URL da Api requisitada
        $apiGet = 'https://pokeapi.co/api/v2/pokemon/' . $nome;

        //Criada variável que armazena os dados da URL em string json
        $retornoApi = file_get_contents($apiGet);

        //Condicional para erro no retorno do servidor
        if ($retornoApi === false) {
            header('HTTP 500 Internal Server Error');
            echo "Erro ao fazer a requisição à API.";
            exit;

        //Caso retorne a Api
        }else {
        
        //Criada variável que decodifica os dados de string json para array associativo
        $pokemonData = json_decode($retornoApi, true);

        //Criado array associativo $dataAjustada com a chave 'name' correspondente a chave 'name' do array $pokemonData, e a chave 'stats' vazia
        $dataAjustada = [
            'name' => $pokemonData['name'],
            'stats' => []
        ];

        //Criado loop para percorrer o array $pokemonData['stats']
        foreach ($pokemonData['stats'] as $stat) {
            $dataAjustada['stats'][$stat['stat']['name']] = $stat['base_stat'];
        }

        //Gravação dos dados lidos e retornados da Api em um novo arquivo Txt como string json
        file_put_contents($nomePokemon, json_encode($dataAjustada));

        //Indicação do conteúdo em formato json e impressão dos dados ajustados
        header('Content-Type: application/json');
        echo (json_encode($dataAjustada));
    }
    }

//Retorno de erro no caso da requisição não ser GET e não conter o parâmetro 'name' na URL passada
} else {
    header('HTTP 400 Bad Request');
    echo "Erro na requisição.";
}


/* - Iniciar o servidor com php -S localhost:8100
- No navegador colocar o endereço http://localhost:8100/api_nome_pokemon.php/pokemon?name=
- Endereço API pokemon - https://pokeapi.co/api/v2/pokemon/
*/