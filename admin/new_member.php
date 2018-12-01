<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['action'])) {
        if($_POST['action'] == "approve") {
            $user_admin = new UserAdmin();
            $user_admin->id = $_POST['id'];
            $user_admin->update_status_new_user();
        } elseif($_POST['action'] == "unapprove") {
            $user_admin = new UserAdmin();
            $user_admin->id = $_POST['id'];
            $user_admin->delete_user_by_id();
        }
    }
?>
<table class="user-admin--table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Username</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Role</td>
            <td>Status</td>
            <td>Approve</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $user_admin = new UserAdmin();
    $user_result = $user_admin->find_user_by_status_pending();

    foreach($user_result as $value) {
?>
        <tr>
            <td><?php echo $value->id; ?></td>
            <td><?php echo $value->first_name; ?></td>
            <td><?php echo $value->last_name; ?></td>
            <td><?php echo $value->username; ?></td>
            <td><?php echo $value->email; ?></td>
            <td><?php echo $value->phone; ?></td>
            <td><?php echo $value->role; ?></td>
            <td><?php echo $value->status; ?></td>
            <td><button class="approve--button" data-id=<?php echo $value->id; ?>>อนุมัติ</button><button class="unapprove--button" data-id=<?php echo $value->id; ?>>ไม่อนุมัติ</button></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<form id="approve-form" method="POST">
    <input type="hidden" name="id">
    <input type="hidden" name="action">
</form>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    var approve = document.querySelectorAll('.approve--button');
    for(var i = 0; i < approve.length; i++) {
        approve[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "approve";
            form.submit();
        })
    }

    var unapprove = document.querySelectorAll('.unapprove--button');
    for(var i = 0; i < approve.length; i++) {
        unapprove[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "unapprove";
            form.submit();
        })
    }
</script>