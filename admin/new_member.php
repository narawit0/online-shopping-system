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
<table class="admin--table">
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
            <td><button class="user-approve--button" data-id=<?php echo $value->id; ?>>อนุมัติ</button><button class="user-unapprove--button" data-id=<?php echo $value->id; ?>>ไม่อนุมัติ</button></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<form id="user-approve-form" method="POST">
    <input type="hidden" name="id">
    <input type="hidden" name="action">
</form>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    var user_approve = document.querySelectorAll('.user-approve--button');
    for(var i = 0; i < user_approve.length; i++) {
        user_approve[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('user-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "approve";
            form.submit();
        })
    }

    var user_approveunapprove = document.querySelectorAll('.user-unapprove--button');
    for(var i = 0; i < user_approveunapprove.length; i++) {
        user_approveunapprove[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('user-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "unapprove";
            form.submit();
        })
    }
</script>