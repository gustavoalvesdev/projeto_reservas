<?php 

$data = '2020-12';

$dia1 = date('w', strtotime($data . '-01'));
$dias = date('t', strtotime($data));
$linhas = ceil(($dia1 + $dias) / 7);
$dia1 = -$dia1;
$dataInicio = date('Y-m-d', strtotime($dia1.' days', strtotime($data)));
$dataFim = date('Y-m-d', strtotime((($dia1 + ($linhas * 7) - 1)).' days', strtotime($data)));

echo 'PRIMEIRO DIA: '.$dia1.'<br />';
echo 'TOTAL DIAS: '.$dias.'<br />';
echo 'LINHAS: '.$linhas.'<br />';
echo 'DATA INÍCIO: '.$dataInicio.'<br />';
echo 'DATA FIM: '.$dataFim.'<br />';