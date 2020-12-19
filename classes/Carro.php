<?php 

class Carro 
{
    private PDO $pdo;
    private int $id;
    private string $nome;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getId() : int 
    {
        return $this->id;
    }

    public function setId(int $id) : void 
    {
        $this->id = $id;
    } 

    public function getNome() : string 
    {
        return $this->nome;
    }

    public function setNome(string $nome) : void 
    {
        $this->nome = $nome;
    }

    public function getCarros() : array 
    {
        $array = array();

        $sql = 'SELECT * FROM carros';

        $sql = $this->pdo->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getNomeCarroById(int $id) : string
    {
        $nomeCarro = '';

        $sql = 'SELECT nome FROM carros WHERE id = :id';
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $nomeCarro = $sql->fetch()['nome'];
        }

        return $nomeCarro;
    }
}
