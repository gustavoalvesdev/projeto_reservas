<?php

require_once 'config.php';
require_once 'classes/Carro.php';
require_once 'classes/Reserva.php';

$reservas = new Reserva($pdo);
$carro = new Carro($pdo);

?>
<h1>Reservas</h1>

<a href="reservar.php">Adicionar Reserva</a><br /><br />

<form method="GET">
    <select name="ano">
        <?php for ($i = date('Y'); $i >= 2000; $i--) : ?>
            <option value="<?= $i ?>" <?= (isset($_GET['ano']) && $_GET['ano'] == $i) ? 'selected' : $i ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <select name="mes">
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= $i ?>" <?= (isset($_GET['mes']) && $_GET['mes'] == $i) ? 'selected' : $i ?>><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <input type="submit" value="Mostrar" />
</form> 

<?php 

if (empty($_GET['ano'])) {
    exit;
}

$data = $_GET['ano'].'-'.$_GET['mes'];

$dia1 = date('w', strtotime($data . '-01'));
$dias = date('t', strtotime($data));
$linhas = ceil(($dia1 + $dias) / 7);
$dia1 = -$dia1;
$dataInicio = date('Y-m-d', strtotime($dia1.' days', strtotime($data)));
$dataFim = date('Y-m-d', strtotime((($dia1 + ($linhas * 7) - 1)).' days', strtotime($data)));

$lista = $reservas->getReservas($dataInicio, $dataFim);

/*foreach($lista as $item) : ?>
    <?php  $data1 = date('d/m/Y', strtotime($item['data_inicio'])); ?>
    <?php  $data2 = date('d/m/Y', strtotime($item['data_fim'])); ?>
    <?= $item['pessoa'].' reservou o carro '.$item['id_carro'].' entre '.$data1.' e '.$data2.'<br />' ?>

<?php endforeach; */ ?>

<hr />

<?php 

require_once 'calendario.php';

?>

