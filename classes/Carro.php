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

}
