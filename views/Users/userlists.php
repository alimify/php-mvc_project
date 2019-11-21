<form class="text-center" method="post">
<table id="table" class="display">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Regiter ON</th>
            <?php if($_SESSION['user_data']['role'] == 1){ echo '<th>Select</th>'; } ?>
        </tr>
    </thead>
    <tbody>

<?php
foreach ($viewmodel as $user) { ?>


        <tr>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?php echo $user['status'] == 1 ? '<font color="green">Active</font>' : '<font color="red">De-active</font>'; ?></td>
            <td><?= $user['join_time'] ?></td>
                       <?php if($_SESSION['user_data']['role'] == 1){  ?>           
            <td><input type="checkbox" name="id[]" value="<?= $user['id'] ?>"></td> <?php } ?>
        </tr>

<?php } ?>

   </tbody>
</table>
           <?php if($_SESSION['user_data']['role'] == 1){  ?>
<input type="submit" name="active" class="btn btn-success" value="Active">
<input type="submit" name="deactive" class="btn btn-danger" value="De-active">
<?php } ?>

</form>