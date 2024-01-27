<?php
/*
require_once 'src/Modelo/Pessoa.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/Funcionario.php';
require_once 'src/Modelo/Cliente.php'; */

require_once 'autoload.php';

use Lemos\Comercial\Infraestrutura\Persistencia\CriadorConexao;

use Lemos\Comercial\Infraestrutura\Repositorio\PdoRepositorioCliente;

use Lemos\Comercial\Infraestrutura\Repositorio\PdoRepositorioFuncionario;

use Lemos\Comercial\Dominio\Modelo\Endereco;
use Lemos\Comercial\Dominio\Modelo\Cliente;
use Lemos\Comercial\Dominio\Modelo\Funcionario;

echo "<pre>";

    echo "<h1>Comercial</h1>";

    $endereco1 = new Endereco(
        NULL, "AP", "Macapá",
        "Av. da Cidade", "100", "Centro",
        "68900-000", NULL);
    
    $endereco2 = new Endereco(
        NULL, "AP", "Macapá",
        "Rua da Cidade", "200", "Universitário",
        "68900-000", NULL);
    
    $endereco3 = new Endereco(
        NULL, "AP", "Macapá",
        "Travessa da Cidade", "500", "Zerão",
        "68900-000", NULL);

    $endereco4 = new Endereco(
        NULL, "AP", "Macapá",
        "Passagem da Cidade", "1000", "Equatorial",
        "68900-000", NULL);

    $funcionario1 = new funcionario(
        NULL,
        "Edson Maia",
        new DateTimeImmutable("1981-06-19"),
        $endereco1,
        "Desenvolvedor",
        3000.00);
    
    $funcionario2 = new funcionario(
        NULL,
        "Maitê Maia",
        new DateTimeImmutable("2000-10-10"),
        $endereco1,
        "Designer",
        2500.00);

    $funcionario3 = new funcionario(
        NULL,
        "Jobs Gates",
        new DateTimeImmutable("1965-11-11"),
        $endereco2,
        "CEO",
        1000000.00);
    

    $cliente2 = new Cliente(NULL, "Ana Silva", new DateTimeImmutable("1980-11-11"), $endereco2, 1800.00);
    $cliente3 = new Cliente(NULL, "Paulo Santos", new DateTimeImmutable("1991-10-10"), $endereco3, 1500.00);
    $cliente4 = new Cliente(NULL, "Bia", new DateTimeImmutable("1995-09-09"), $endereco4, 1200.00);

    $cliente = new Cliente(5, "Maria Maia", new DateTimeImmutable("1954-10-12"), $endereco4, 1100.00);

    //SALVAR NOVOS CLIENTES
    //$repositorioClientes->salvar($cliente2);

    //UPDATE ou ATUALIZAR ENDEREÇO
    //$endereco = new Endereco(NULL, "AP", "Macapá", "Av. da Cidade", "100", "Centro", "68900-000", $cliente->getId());
    //$repositorioClientes->atualizaEndereco($endereco, $cliente);

    //$resultado = $repositorioClientes->todosClientes();
    $resultado = $repositorioClientes->todosClientesComEndereco();

    //ESCREVER
    foreach ($resultado as $client) { echo $client;}

    //DELETE ou APAGAR
    //$repositorioClientes->delete($cliente);

    //UPDATE ou ATUALIZAR CLIENTE
    //$repositorioClientes->updateCliente($cliente);

    //FUNCIONARIO
    $repositorioFuncionarios = new PdoRepositorioFuncionario(CriadorConexao::criarConexao());

    //SALVAR ou CRIAR NOVO
    $repositorioFuncionarios->salvar($funcionario1);
    $repositorioFuncionarios->salvar($funcionario2);
    $repositorioFuncionarios->salvar($funcionario3);

    //VER TODOS
    //$resultado = $repositorioFuncionarios->todosFuncionarios();
    $resultado = $repositorioFuncionarios->todosFuncionariosComEndereco();

    //ESCREVER
    foreach($resultado as $func) { echo $func; }

    echo $funcionario1;
    echo $cliente1;

    //echo $funcionario1->getDataNascimento()->format('d/m/Y');

    $repositorio = new PdoRepositorioProduto(CriadorConexao::criarConexao());
    var_dump($repositorio);

    $produto1 = new Produto(NULL, "Tablet", 3000);
    $produto2 = new Produto(NULL, "Notebook", 4000);
    $produto3 = new Produto(NULL, "Mouse", 150);
    $produto4 = new Produto(NULL, "Teclado Mecânico", 450);
    $produto5 = new Produto(NULL, "Fone de ouvido", 500);
    $produto6 = new Produto(NULL, "Cadeira", 1200);
    $produto7 = new Produto(NULL, "Mouse Pad", 100);

    var_dump($produto1);
    $produto0 = new Produto(13, "Tablet Samsung", 4500);

    //UPDATE DO PRODUTO
    //$repositorio->updateProduto($produto0);

    //DELETAR
    //$repositorio->deleteProduto($produto0);


    //EXIBIR TODOS OS PRODUTOS COM O MÉTODO todosProdutos()
    $repositorio->todosProdutos();

    //CONSULTAR PRODUTO POR ID
    $repositorio->readProduto($produto);

    //ADICIONAR PRODUTOS COM O MÉTODO salvar()

    /*
    $repositorio->salvar($produto1);
    $repositorio->salvar($produto2);
    $repositorio->salvar($produto3);
    $repositorio->salvar($produto4);

    $repositorio->todosProdutos();*/

    $repositorioClientes = new PdoRepositorioCliente(CriadorConexao::criarConexao());

    $repositorioClientes->salvar($cliente1);

echo "</pre>";


/*
use Lemos\Comercial\Modelo\Pessoa;
use Lemos\Comercial\Modelo\Endereco;
use Lemos\Comercial\Modelo\Funcionario;
use Lemos\Comercial\Modelo\Cliente;

$endereco1 = new Endereco("AP", "Macapá", "Av. da Cidade", "100", "Central", "68900-000");
//$pessoa1 = new Pessoa("Gustavo Lemos", 40, $endereco1); // instanciado ou criado um novo objeto do tipo Pessoa
//$pessoa2 = new Pessoa("Fulano", 30, $endereco1);
//$pessoa3 = new Pessoa("Alex", 49, $endereco1);
//unset($pessoa3); //Tirando a referência ao objeto $pessoa3

echo "<pre>";
$funcionario1 = new Funcionario("Edson Maia", 39, $endereco1, "Desenvolvedor", 3000);
var_dump($funcionario1);

$cliente1 = new Cliente("Maria", 20, $endereco1, "1990-01-01", 1000);
var_dump($cliente1);

echo $funcionario1->__toString();
echo "<hr>";
echo $cliente1->__toString();

echo "</pre>";

$funcionario1->setSenha("123");

$funcionario1->login("Edson Maia", "123");

echo $endereco1->nomeLogradouro;
echo "<br>";
echo $endereco1->bairro;

echo "<p> $cliente1->nome </p>";
echo "<p> $funcionario1->nome </p>";

echo "<p>Número de Pessoas: ". Pessoa::getNumDePessoas() ."</p>";


//Como setar valores para os atributos de um objeto:
//Esse formato pode alterar os dados posteriormente
/*
$pessoa1->nome = "Gustavo Lemos";
$pessoa1->idade = 40;
$pessoa2->nome = "Fulano";
$pessoa2->idade = 30;
*/
/*
//Como pegar ou escrever o conteúdo de um atributo
echo "<p>Nome: $pessoa1->nome </p>";
echo "<p>Idade: $pessoa1->idade </p>";
echo "<hr>";
echo "<p>Nome: $pessoa2->nome </p>";
echo "<p>Idade: $pessoa2->idade </p>";
*/

/*//USAR MÉTODOS ACESSORES
$pessoa1->setNome("Gustavo Lemos");
$pessoa1->setIdade(40);

$pessoa2->setNome("Fulano");
$pessoa2->setIdade(30);

echo "<p>Nome: {$pessoa1->getNome()} </p>";
echo "<p>Idade: {$pessoa1->getIdade()} </p>";

echo "<p>Nome: {$pessoa2->getNome()} </p>";
echo "<p>Idade: {$pessoa2->getIdade()} </p>";

echo "<pre>"; //tag pre organiza a impressão do código
var_dump($pessoa1);
var_dump($pessoa2);
echo "</pre>"; */