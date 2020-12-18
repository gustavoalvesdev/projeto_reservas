<?php 

class Reserva 
{
    private PDO $pdo;
    private int $id;
    private int $idCarro;
    private string $dataInicio;
    private string $dataFim;
    private string $pessoa;

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

    public function getIdCarro() : int 
    {
        return $this->idCarro;
    }

    public function setIdCarro(int $idCarro) : void 
    {
        $this->idCarro = $idCarro;
    }

    public function getDataInicio() : string 
    {
        return $this->dataInicio;
    }

    public function setDataInicio(DateTime $dataInicio) : void 
    {
        $this->dataInicio = $dataInicio;
    }

    public function getDataFim() : string 
    {
        return $this->dataFim;
    }

    public function setDataFim(DateTime $dataFim) : void 
    {
        $this->dataFim = $dataFim;
    }

    public function getPessoa() : string 
    {
        return $this->pessoa;
    }

    public function setPessoa(string $pessoa) : void 
    {
        $this->pessoa = $pessoa;
    }


    public function getReservas() : array 
    {
        $array = [];

        $sql = 'SELECT * FROM reservas';
        $sql = $this->pdo->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarDisponibilidade(int $carro, string $dataInicio, string $dataFim) : bool
    {   
        $sql = 'SELECT * FROM reservas WHERE id_carro = :carro AND (NOT(data_inicio > :data_fim OR data_fim < :data_inicio))';
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':carro', $carro);
        $sql->bindValue(':data_inicio', $dataInicio);
        $sql->bindValue(':data_fim', $dataFim);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        }

        return true;
    }

    public function reservar(int $carro, string $dataInicio, string $dataFim, string $pessoa) : void
    {
        $sql = 'INSERT INTO reservas (id_carro, data_inicio, data_fim, pessoa) VALUES(:id_carro, :data_inicio, :data_fim, :pessoa)';
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':id_carro', $carro);
        $sql->bindValue(':data_inicio', $dataInicio);
        $sql->bindValue(':data_fim', $dataFim);
        $sql->bindValue(':pessoa', $pessoa);

        $sql->execute();
    }

}
