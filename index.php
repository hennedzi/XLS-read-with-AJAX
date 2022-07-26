<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tid').DataTable();
            
        });
    </script>
</head>

<body>
    <?php
    include 'script.php';
    ?>
        <table id="tid" class="display" style="width:100%">
            <thead>
                <tr >
                    <th>Наименование товара</th>
                    <th>стоимость руб</th>
                    <th>стоимость опт</th>
                    <th>Наличие на складе 1</th>
                    <th>Наличие на складе 2</th>
                    <th>Страна</th>
                    <th>Примечание</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list as $row) : ?>
                    <tr id="trid" >
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['cost']; ?></td>
                        <td ><?php echo $row['wholesale_cost']; ?></td>
                        <td><?php echo $row['first_stock_Availability']; ?></td>
                        <td><?php echo $row['second_stock_Availability']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php
                            if ($row['first_stock_Availability'] + $row['second_stock_Availability'] < 20) {
                                echo "Осталоась мало, срочно докупите";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <script src="rowColor.js"></script>
    <?php
    $f=0;
    $s=0;
    $cost=0;
    $wcost=0;
    foreach($list as $i){
    $f+=$i['first_stock_Availability'];
    $s+=$i['second_stock_Availability'];
    $cost+=$i['cost'];
    $wcost+=$i['wholesale_cost'];
    }
    ?>
    <p><?php echo "Первый склад: ".$f;?></p>
    <p><?php echo "Второй склад: ".$s;?></p>
    <p><?php echo "средняя розничная стоимость: ".($cost/992);?></p>
    <p><?php echo "средняя оптовая стоимость: ".($wcost/992);?></p>

</body>

</html>