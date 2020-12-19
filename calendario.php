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
                    $t = strtotime(($j + ($i * 7)) . ' days', strtotime($dataInicio));    
                    $w = date('Y-m-d', $t);
                ?>
                <td>
                    <?php
                        
                        echo date('d/m', $t).'<br /><br />';
                        $w = strtotime($w);

                        foreach($lista as $item) {
                            $drInicio = strtotime($item['data_inicio']);
                            $drFim = strtotime($item['data_fim']);

                            $nomeCarro = $carro->getNomeCarroById($item['id_carro']);

                            if ($w >= $drInicio && $w <= $drFim) {
                                echo $item['pessoa'].' ('.$nomeCarro.')'.'<br />';
                            }
                        }
                    ?>
                </td>

            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>