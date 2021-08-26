<?php if (!empty($stat) and !is_null($stat['stat']) and is_array($stat) and $d_measure->format("Y-m-d") <= date("Y-m-d")) : ?>
    <div class="row align-items-start">
        <div class="col">
            <h1 class="text-center"><?= lang("Table.header") ?><?= $d_measure->format("Y-m-d") ?></h1>

            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center"><?= lang("Table.dom") ?></th>
                        <th scope="col" class="text-center"><?= lang("Table.cap") ?></th>
                        <th scope="col" class="text-center">%</th>
                        <th scope="col" class="text-center"><?= lang("Table.growth") ?></th>
                        <th scope="col" class="text-center"><?= lang("Table.growth_rate") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cap_sum = 0;
                    $perc_sum = 0;
                    $diff_sum = 0;
                    if (isset($stat) && is_array($stat)) {
                        foreach ($stat['stat'] as $d) {
                            if ($d['pubdom_name'] === 'ua') {
                                $row = "<tr>";
                                $row .= "<td><a class='text-decoration-none' href='#' onClick=\"setPubdom('" . $d['pubdom_name'] . "')\">" . $d['pubdom_name'] . "</a></td>";
                                $row .= "<td style='text-align: right;'>" . $d['capacity'] . "</td>";
                                $cap_sum += $d['capacity'];
                                $row .= "<td style='text-align: right;'>" . $d['perc'] . "</td>";
                                $perc_sum += $d['perc'];
                                $row .= "<td style='text-align: right;'>" . $d['diff'] . "</td>";
                                $diff_sum += $d['diff'];
                                $row .= "<td style='text-align: right;'>" . $d['pripost'] . "</td>";
                                $row .= "</tr>";
                                echo $row;
                            }
                        }
                        foreach ($stat['stat'] as $d) {
                            if ($d['pubdom_name'] !== 'ua') {
                                $row = "<tr>";
                                $row .= "<td><a class='text-decoration-none' href='#' onClick=\"setPubdom('" . $d['pubdom_name'] . "')\">" . $d['pubdom_name'] . "</a></td>";
                                $row .= "<td style='text-align: right;'>" . $d['capacity'] . "</td>";
                                $cap_sum += $d['capacity'];
                                $row .= "<td style='text-align: right;'>" . $d['perc'] . "</td>";
                                $perc_sum += $d['perc'];
                                $row .= "<td style='text-align: right;'>" . $d['diff'] . "</td>";
                                $diff_sum += $d['diff'];
                                $row .= "<td style='text-align: right;'>" . $d['pripost'] . "</td>";
                                $row .= "</tr>";
                                echo $row;
                            }
                        }
                    }
                    ?>
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td scope="row"><?= lang("Table.together") ?></td>
                        <td style="text-align: right;"><?= $cap_sum ?></td>
                        <td style="text-align: right;"><?= round($perc_sum) ?>%</td>
                        <td style="text-align: right;"><?= $diff_sum ?></td>
                        <td style="text-align: right;">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col">
            <h1 class="text-center"><span id="pubdom_name"><?= $p_host ?></span></h1>

            <div id="chart_div" style="width: 80%; min-width: 400px; height: 300px; margin: 0 auto;"></div>
            <script src="<?= base_url('/assets/js/script.js') ?>"></script>
        </div>
    </div>

<?php else : ?>
    <h1><?= lang("Table.data") ?></h1>
<?php endif ?>