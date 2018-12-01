<?php include("includes/header.php"); ?>
<table class="admin--table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Username</td>
            <td>Email</td>
            <td>Phone</td>
            <td>address</td>
            <td>role</td>
            <td>status</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $user_result = $user_admin->find_all_users();

    foreach($user_result as $value) {
?>
        <tr>
            <td><?php echo $value->id; ?></td>
            <td><?php echo $value->first_name; ?></td>
            <td><?php echo $value->last_name; ?></td>
            <td><?php echo $value->username; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->phone; ?></td>
            <td><?php echo $value->address; ?></td>
            <td><?php echo $value->role; ?></td>
            <td><?php echo $value->status; ?></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<form id="seller-approve-form" method="POST">
    <input type="hidden" name="id">
    <input type="hidden" name="action">
</form>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    var seller_approve = document.querySelectorAll('.seller-approve--button');
    for(var i = 0; i < seller_approve.length; i++) {
        seller_approve[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('seller-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "approve";
            form.submit();
        })
    }

    var seller_unapprove = document.querySelectorAll('.seller-unapprove--button');
    for(var i = 0; i < seller_unapprove.length; i++) {
        seller_unapprove[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('seller-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "unapprove";
            form.submit();
        })
    }
</script>