<?php include("includes/header.php"); ?>
<?php include("show_products.php");?>
<script>
    function add_product_to_cart(pro_id, quanity=1) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "add_cart.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
            }
        }
        xmlhttp.send("id=" + pro_id + "&quanity=" + quanity);
    }
</script>
<?php include("includes/footer.php"); ?>
    
