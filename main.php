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
            <input type="range" min="1" max="100" value="50">
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