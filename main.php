
<?php 
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    if(isset($_GET['price1']) && isset($_GET['price2'])) {
        $price1 = $_GET['price1'];
        $price2 = $_GET['price2'];
        if($price1 > $price2) {
            $tmp = $price2;
            $price2 = $price1;
            $price1 = $tmp;
        }
    }
?>
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
                <?php 
                    $min_result = Product::select_min_price_of_products();
                    $max_result = Product::select_max_price_of_products();

                    $row1 = mysqli_fetch_assoc($min_result);
                    $min_price = $row1['min_price'];

                    $row2 = mysqli_fetch_assoc($max_result);
                    $max_price = $row2['max_price'];
                ?>
                <input type="range" id="range-1" value="<?php if(isset($price1)){ echo $price1; } else { if(isset($min_price)) echo $min_price; } ?>" min="<?php if(isset($min_price)) echo $min_price; ?>" max="<?php if(isset($max_price)) echo $max_price; ?>">
                <input type="range" id="range-2" value="<?php if(isset($price2)){ echo $price2; } else { if(isset($max_price)) echo $max_price; }?>" min="<?php if(isset($min_price)) echo $min_price; ?>" max="<?php if(isset($max_price)) echo $max_price; ?>">
            </section>
            <button class="price-search">ค้นหา</button>
            <form id="price-search-form">
                <input type="hidden" name="price1">
                <input type="hidden" name="price2">
            </form>
            </aside>
            <section id="main-conntent--right" class="main-conntent--right">
            <?php 
                if(!empty($_GET['cat_id']) || isset($_GET['cat_id'])) {
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
                } elseif( (empty($_GET['cat_id']) || !isset($_GET['cat_id'])) && (empty($_GET['price1']) || !isset($_GET['price1']))) {
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
                } elseif((isset($_GET['price1']) || !empty($_GET['price1'])) && (isset($_GET['price2']) || !empty($_GET['price2']))) {
                    $price1 = $_GET['price1'];
                    $price2 = $_GET['price2'];
            ?>
                <script type="text/javascript">
                    function show_all_products_with_search_price(price1, price2, page) {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "products_price_search.php?price1= " + price1 + "&price2= " + price2 + "&page= " + page, true);
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById('main-conntent--right').innerHTML = this.responseText;
                            }
                        }
                        xmlhttp.send();
                    }

                    show_all_products_with_search_price(<?php echo $price1; ?>, <?php echo $price2; ?>, <?php echo $page; ?>)
                </script>
            <?php
                }
            ?>
            </section>
            <div id="popup"></div>
        </div>
    </main>
    <script type="text/javascript">
        var price_search_btn = document.querySelector('.price-search');

        price_search_btn.addEventListener('click', function() {
            var range_slider = document.querySelector('.range-slider');
            var input = range_slider.getElementsByTagName('input');
            var price1 = parseInt(input[0].value);
            var price2 = parseInt(input[1].value);
            var form = document.getElementById('price-search-form');
            form.querySelector("input[name='price1']").value = price1;
            form.querySelector("input[name='price2']").value = price2;
            form.method = "GET";
            form.submit();
        });
    </script>