<?php include("includes/header.php"); ?>
<style type="text/css">
    .main-content > .container {
        display: flex;
        margin-top: 2rem;

    }

    .main-content--left {
        flex-basis: 30%;
        padding: 2rem;
    }

    .main-conntent--right {
        flex: 1;
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        /* align-items: center; */
    }

    .main-conntent--right > * {
        flex-basis: 33.333333%;
    }

    .product {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 25rem;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding: 1rem;
        transition: background-color .8s, color .3s, transform .8s;
        border-radius: 1rem;
    }

    .product:hover {
        transform: translateY(-1rem) translateX(-1rem);
        background-image: linear-gradient(to right, var(--color-primary-dark), var(--color-secondary-dark));
        color: var(--color-white);
    }

    .product:hover .product--button-buy {
        background-color: var(--color-grey-dark-1);
    }



    .product--image > img {
        height: 100%;
        width: 12rem;
    }

    .button-group {
        align-self: stretch;
        display: flex;
        justify-content: space-around;
    }

    .product--button {
        padding: 1rem;
        flex-basis: 48%;
        text-align: center;
        border-radius: 1rem;
        color: var(--color-white);
        transition: all .3s;
    }

    .product--button:hover {
        transform: translateY(-.5rem);
    }

    .product--button-detail {
        background-color: var(--color-primary-light); 
    }

    .product--button-buy{
        background-color: var(--color-secondary-dark);
    }


    #product-popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform:translate(-50%, -50%);
            z-index: 1;
            width: 50rem;
            background-color: pink;
        }

        .product-popup--header {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: var(--color-primary-dark);
            color: white;
        }

        .product-popup--close {
            cursor: pointer;
        }


        .product-popup--image {
            margin: 0;
            padding: 0;
            flex-basis: 48%;
        }

        .product-popup--image > img {
            margin: 0;
            width: 100%;
            display: block;
        }

        .product-popup--detail {
            display: flex;
            background-color: var(--color-grey-dark-1);
            justify-content: space-between;
            padding: 2rem;
            color: var(--color-white);
        }

        .product-popup--text {
            flex-basis: 48%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            font-size: 1.2rem;
            color: var(--color-secondary-dark);
        }

        .product-popup--title {
            margin-bottom: .5rem;
        }

        .product-popup--footer {
            background-color: var(--color-primary-dark);
        }

        .product-popup--footer > form {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        .product-popup--footer > form > input {
            width: 3rem;
            padding: .2rem;
        }
</style>
    <main class="main-content">
        <div class="container">
            <aside class="main-content--left">
                test
            </aside>
            <section class="main-conntent--right">
                <?php
                    if(empty($_GET['cat_id']) || !isset($_GET['cat_id'])) {

                    $products = Product::select_all_products(); 
                    while($row = mysqli_fetch_assoc($products)) {
                ?>
                    <div class="product">
                        <figure class="product--image">
                            <img src="<?php echo "." . DS . "images" . DS . $row['image']?>" alt="">
                        </figure>
                        <span class="product--price">ราคา: <?php echo $row['price']; ?> บาท</span>
                        <span class="product--name">ชื่อสินค้า: <?php echo $row['name']?></span>
                        <div class="button-group">
                            <a href="javascript:void(0);" class="product--button product--button-detail" onclick="show_product_details(<?php echo $row['id']; ?>)">รายละเอียด</a>
                            <a href="" class="product--button product--button-buy">ซื้อเลย</a>
                        </div>
                    </div>
                <?php        
                    }
                } elseif(!empty($_GET['cat_id']) || isset($_GET['cat_id'])) {
                    $cat_id = $_GET['cat_id'];

                    $products = Product::select_products_by_cat_id($cat_id); 
                    while($row = mysqli_fetch_assoc($products)) {
                ?>
                    <div class="product">
                        <figure class="product--image">
                            <img src="<?php echo "." . DS . "images" . DS . $row['image']?>" alt="">
                        </figure>
                        <span class="product--price">ราคา: <?php echo $row['price'];?> บาท</span>
                        <span class="product--name">ชื่อสินค้า: <?php echo $row['name']; ?></span>
                        <div class="button-group">
                            <a href="javascript:void(0);" class="product--button product--button-detail" onclick="show_product_details(<?php echo $row['id']; ?>)">รายละเอียด</a>
                            <a href="" class="product--button product--button-buy">ซื้อเลย</a>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
            </section>
            <div id="popup"></div>
        </div>
    </main>
<script type="text/javascript">
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
</script>
<?php include("includes/footer.php"); ?>
    
