<?php
    namespace Lemos\Comercial\Dominio\Modelo;
    require_once 'autoload.php';

    use DateTimeInterface;

    abstract class Pessoa
    {
        use AcessoAtributos;
        // ATRIBUTOS = variáveis
        protected ?int $id;
        protected string $nome;
        protected DateTimeInterface $dataNascimento;
        protected Endereco $endereco; //ASSOCIAÇÃO (AGREGAÇÃO) Pessoa tem um Endereco
        protected float $desconto;
        private static int $numDePessoas = 0;

        // COMPORTAMENTOS, MÉTODOS = funções
        //CONSTRUTOR
        public function __construct(?int $id, string $nome, DateTimeInterface $dataNascimento, Endereco $endereco)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->dataNascimento = $dataNascimento;
            $this->validaIdade($idade);
            $this->endereco = $endereco;
            $this->setDesconto(); //Definindo o desconto
            self::$numDePessoas++; //Minha classe Pessoa tem um atributo estático que vai receber mais 1.
        }

        //DESTRUTOR
        public function __destruct()
        {
            self::$numDePessoas--;
        }

        //ACESSORES os métodos que dão acesso get = pega, set = seta ou edita - dão privacidade aos dados
        // GET
        public function getNome(): string
        {
            return $this->nome;
        }

        public function getDataNascimento(): DateTimeInterface
        {
            return $this->dataNascimento;
        }

        // SET
        public function setNome(string $nome): void
        {
            $this->nome = $nome;
        }

        public function setDataNascimento(DateTimeInterface $dataNascimento): void
        {
            $this->dataNascimento = $dataNascimento;
        }

        public static function getNumDePessoas(): int
        {
            return self::$numDePessoas;
        }

        //MÉTODOS ESPECÍFICOS
        /*private function validaIdade(int $idade): void
        {
            if($this->idade >0 AND $this->idade < 120){
                $this->idade = $idade;
            } else {
                echo "Idade não permitida!";
                exit;
            }
        } */

        public function idade(): int
        {
            return $this->getDataNascimento()
            ->diff(new \DateTimeImmutable())
            ->y;
        }

        protected abstract function setDesconto(): void; //os que usam Pessoa precisam implementar esse método em sua classe

        public function getDesconto(): float
        {
            return $this->desconto;
        }

        public function setEndereco(Endereco $endereco): void
        {
            $this->endereco = $endereco;
        }

        public function getEndereco(): Endereco
        {
            return $this->endereco;
        }

        public abstract function __toString(): string;

    }