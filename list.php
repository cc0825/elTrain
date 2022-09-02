<?php
namespace Phppot;

$result = $userModel->getAllTrains();
if (! empty($result)) {
    ?>
<table id='trainTable'>
    <thead>
        <tr>
            <th>Train Line</th>
            <th>Route Name</th>
            <th>Run Number</th>
			<th>Operator ID</th>
        </tr>
    </thead>
<?php
    foreach ($result as $row) {
        ?>
                <tbody>
        <tr>
            <td><?php  echo $row['train_line']; ?></td>
            <td><?php  echo $row['route_name']; ?></td>
            <td><?php  echo $row['run_number']; ?></td>
			<td><?php  echo $row['operator_id']; ?></td>
        </tr>
                    <?php
    }
    ?>
                </tbody>
</table>

<?php } ?>