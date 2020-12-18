<?php

require_once 'config.php';
require_once 'classes/Carro.php';
require_once 'classes/Reserva.php';

$reservas = new Reserva($pdo);
$carros = new Carro($pdo);

if (!empty($_POST['carro'])) {

    $carro = addslashes($_POST['carro']);
    $dataInicio = explode('/', addslashes($_POST['data_inicio']));
    $dataFim = explode('/', addslashes($_POST['data_fim']));
    $pessoa = addslashes($_POST['pessoa']);

    $dataInicio = $dataInicio[2] . '-' . $dataInicio[1] . '-' . $dataInicio[0];
    $dataFim = $dataFim[2] . '-' . $dataFim[1] . '-' . $dataFim[0];

    if ($reservas->verificarDisponibilidade($carro, $dataInicio, $dataFim)) {
        $reservas->reservar($carro, $dataInicio, $dataFim, $pessoa);
        header('Location: index.php');
        exit;
    } else {
        echo 'Este carro já está reservado neste período.';
    }

}

?>

<h1>Adicionar Reserva</h1>

<form method="POST">
    Carro:<br />
    <select name="carro">
        <?php $lista = $carros->getCarros(); ?>

        <?php foreach ($lista as $carro) : ?>

            <option value="<?= $carro['id'] ?>"><?= $carro['nome'] ?></option>

        <?php endforeach; ?>

    </select><br /><br />

    Data de Início:<br />
    <input type="text" name="data_inicio" /><br /><br />

    Data de Fim:<br />
    <input type="text" name="data_fim" /><br /><br />

    Nome da Pessoa:<br />
    <input type="text" name="pessoa"/><br /><br />

    <input type="submit" value="Reservar" />

</form>
