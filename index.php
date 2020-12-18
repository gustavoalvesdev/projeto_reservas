<?php

require_once 'config.php';
require_once 'classes/Carro.php';
require_once 'classes/Reserva.php';

$reservas = new Reserva($pdo);

?>
<h1>Reservas</h1>

<a href="reservar.php">Adicionar Reserva</a><br /><br />

<?php 

$lista = $reservas->getReservas();

foreach($lista as $item) : ?>
    <?php  $data1 = date('d/m/Y', strtotime($item['data_inicio'])); ?>
    <?php  $data2 = date('d/m/Y', strtotime($item['data_fim'])); ?>
    <?= $item['pessoa'].' reservou o carro '.$item['id_carro'].' entre '.$data1.' e '.$data2.'<br />' ?>

<?php endforeach; ?>

<hr />

<?php 

require_once 'calendario.php';

?>

<table border="1" width="100%">
    <tr>
        <th>Dom</th>
        <th>Seg</th>
        <th>Ter</th>
        <th>Qua</th>
        <th>Qui</th>
        <th>Sex</th>
        <th>Sáb</th>
    </tr>
    <?php for($i = 0; $i < $linhas; $i++) : ?>
        <tr>
            <?php for ($j = 0; $j < 7; $j++): ?>
                <?php  
                    $w = date('d', strtotime(($j + ($i * 7)) . ' days', strtotime($dataInicio)));    
                ?>
                <td><?= $w ?></td>

            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>