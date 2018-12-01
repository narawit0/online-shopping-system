<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['action'])) {
        if($_POST['action'] == "approve") {
            $seller_admin = new SellerAdmin();
            $seller_admin->id = $_POST['id'];
            $seller_admin->update_seller_status();
        } elseif($_POST['action'] == "unapprove") {
            $seller_admin = new SellerAdmin();
            $seller_admin->id = $_POST['id'];
            $seller_admin->delete_user_by_id();
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
            <td>Bank Account</td>
            <td>Bank Name</td>
            <td>Bank Number</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $seller_admin = new SellerAdmin();
    $seller_result = $seller_admin->get_new_seller();

    while($row = mysqli_fetch_assoc($seller_result)) {
?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['bank_account']; ?></td>
            <td><?php echo $row['bank_name']; ?></td>
            <td><?php echo $row['bank_number']; ?></td>
            <td><button class="seller-approve--button" data-id=<?php echo $row['id']; ?>>อนุมัติ</button><button class="seller-unapprove--button" data-id=<?php echo $row['id']; ?>>ไม่อนุมัติ</button></td>
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