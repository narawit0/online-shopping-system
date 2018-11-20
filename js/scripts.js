
function show_product_details(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "product_details.php?id=" + id, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("popup").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.send();
}

function close_popup() {
    document.getElementById("popup").innerHTML = "";
}

function add_products_to_cart(pro_id, quanity=1) {
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
