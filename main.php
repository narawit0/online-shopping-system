<script>
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
</script>
<main class="main-content">
        <div class="container">
            <aside class="main-content--left">
            <div class="search--price">
                <h4>ราคา</h4>
            </div>
            <section class="range-slider">
                <div class="range-price">
                    <span class="price-1">500</span>
                    <span>-</span>
                    <span class="price-2">15000</span>
                </div>
                <input type="range" id="range-1" value="500" min="500" max="15000">
                <input type="range" id="range-2" value="15000" min="500" max="15000">
            </section>
            <button class="price-search">ค้นหา</button>
            </aside>
            <section id="main-conntent--right" class="main-conntent--right">
            <?php 
                if(!empty($_GET['cat_id']) || isset($_GET['cat_id'])) {
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $cat_id = $_GET['cat_id'];
            ?>
            <script>
                function show_all_products_by_cat_id(cat_id, page) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "show_products_cat_id.php?cat_id= " + cat_id + "&page= " + page, true);
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById('main-conntent--right').innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.send();
                }

                show_all_products_by_cat_id(<?php echo $cat_id; ?>, <?php echo $page; ?>);
            </script>
            <?php
                } else {
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
            ?>
            <script>
                function show_all_products(page) {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "show_all_products.php?page= " + page, true);
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById('main-conntent--right').innerHTML = this.responseText;
                            }
                        }
                        xmlhttp.send();
                }

                show_all_products(<?php echo $page; ?>);
            </script>
            <?php
                }
            ?>
            </section>
            <div id="popup"></div>
        </div>
    </main>