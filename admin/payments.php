<?php include("includes/header.php"); ?>
<?php 
    if(isset($_POST['action'])) {
        if($_POST['action'] == "approve") {
            $payment_admin->id = $_POST['id'];
            if($payment_admin->confirm_payment()) {
                $user_payment_result = $payment_admin->get_user_payments();
                $row = mysqli_fetch_assoc($user_payment_result);
                $order_admin->order_id = $row['order_id'];
                $order_admin->user_id = $row['id'];
                $order_admin->update_payment_status();
            }
        } elseif($_POST['action'] == "unapprove") {
            $payment_admin->id = $_POST['id'];
            $payment_admin->delete_payment_by_id();
        }
    }
?>
<table class="admin--table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Order Id</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Bank</td>
            <td>Amount</td>
            <td>Date Transfer</td>
            <td>Status</td>
            <td>Order Details</td>
            <td>Confirm</td>
        </tr>
    </thead>
    <tbody>
<?php 
    $payment_result = $payment_admin->get_all_payments();

    while($row = mysqli_fetch_assoc($payment_result)) {
?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['bank']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['date_transfer']; ?></td>
            <td><?php echo $row['confirm']; ?></td>
            <td><button><a href="order_details.php?order_id=<?php echo $row['order_id']; ?>">ข้อมูลการสั่งซื้อ</a></button></td>
            <td><button class="payment-approve--button" data-id=<?php echo $row['id']; ?>>อนุมัติ</button><button class="payment-unapprove--button" data-id=<?php echo $row['id']; ?>>ไม่อนุมัติ</button></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<form id="payment-approve-form" method="POST">
    <input type="hidden" name="id">
    <input type="hidden" name="action">
</form>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    var payment_approve = document.querySelectorAll('.payment-approve--button');
    for(var i = 0; i < payment_approve.length; i++) {
        payment_approve[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('payment-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "approve";
            form.submit();
        })
    }

    var payment_unapprove = document.querySelectorAll('.payment-unapprove--button');
    for(var i = 0; i < payment_unapprove.length; i++) {
        payment_unapprove[i].addEventListener('click', function() {
            var user_id = this.getAttribute('data-id');
            var form = document.getElementById('payment-approve-form');
            form.querySelector("input[name='id']").value = user_id;
            form.querySelector("input[name='action']").value = "unapprove";
            form.submit();
        })
    }
</script>