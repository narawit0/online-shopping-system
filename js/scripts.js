
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

document.getElementById('popup').addEventListener('click', function(e){
    if(event.target.id === 'buy') {
        var quanity = document.getElementById('quanity').value;
        var pro_id  = document.getElementById('id').value;
        add_product_to_cart(pro_id, null, quanity);
    }
});

// หยิบสินค้าใส่ตะกร้า
function add_product_to_cart(pro_id, cat_id, quanity=1) {
    console.log(cat_id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "add_cart.php", true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText) {
                alert(this.responseText);
            } else {
                get_cart_count();
                if(!cat_id) {
                    show_all_products();
                } else {
                    show_all_products_by_cat_id(cat_id);
                }
            }
        }
    }
    xmlhttp.send("id=" + pro_id + "&quanity=" + quanity);
}

function show_all_products() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "show_all_products.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('main-conntent--right').innerHTML = this.responseText;
            console.log(this.responseText);
        }
    }
    xmlhttp.send();
}

function show_all_products_by_cat_id(cat_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "show_products_cat_id.php?cat_id= " + cat_id, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('main-conntent--right').innerHTML = this.responseText;
            console.log(this.responseText);
        }
    }
    xmlhttp.send();
}


//นับจำนวนสินค้าในตะกร้า
function get_cart_count() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "cart_count.php", true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('cart--count--display').innerHTML = this.responseText;
            console.log(this.responseText);
        }
    }
    xmlhttp.send();
}



get_cart_count();
