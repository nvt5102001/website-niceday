<div>
    <?php
    if (isset($_GET['page'])) {
        $temp = $_GET['page'];
    } else {
        $temp = '';
    }

    // Trang chủ
    if ($temp == 'home') {
        include("main/home/Home.php");
    } else if ($temp == 'blog') {
        include("main/blog/Blog.php");
    } else if ($temp == 'blogdetail') {
        include("main/blog/BlogDetail.php");
    }

    // Cửa hàng
    else if ($temp == 'shop') {
        include("main/shop/AllProduct/Shop.php");
    }

    // Lọc sản phẩm theo loại sản phẩm
    else if ($temp == 'loaisp') {
        include("main/shop/ProductByCategory/ShopByType.php");
    }

    // Lọc sản phẩm theo thương hiệu
    else if ($temp == 'thuonghieu') {
        include("main/shop/ProductByBrand/ShopByTH.php");
    } else if ($temp == 'price') {
        include("main/shop/ProductByPrice/ShopByPrice.php");
    } elseif ($temp == 'timkiem') {
        include("main/shop/ProductBySearch/ShopByKey.php");
    } elseif ($temp == 'color') {
        include("main/shop/ProductByColor/ShopByColor.php");
    }

    // Chi tiết sản phẩm
    else if ($temp == 'sanpham') {
        include("main/product/SingleProduct.php");
    }

    // Giỏ hàng
    elseif ($temp == 'giohang') {
        include("main/cart/Cart.php");
    }

    // Giỏ hàng
    elseif ($temp == 'pay') {
        include("main/order/Pay.php");
    }
    // Giỏ hàng
    elseif ($temp == 'camon') {
        include("main/order/Thankyou.php");
    }

    // Đăng nhập
    elseif ($temp == 'login') {
        include("main/account/Login.php");
    }

    //Đăng ký
    elseif ($temp == 'signup') {
        include("main/account/Signup.php");
    }

    // Xem lịch sử đơn hàng
    elseif ($temp == 'orderHistory') {
        include("main/order/OrderHistory.php");
    }

    //Xem chi tiết đơn hàng
    elseif ($temp == 'xemctdh') {
        include("main/order/OrderDetail.php");
    }

    // Tìm kiếm lịch sử mua hàng
    elseif ($temp == 'searchOrderHistory') {
        include("main/order/SearchOrderHistory.php");
    }

    // Check out
    elseif ($temp == 'checkout') {
        include("main/order/Checkout.php");
    }

    // Vận chuyển
    elseif ($temp == 'transport') {
        include("main/order/Transport.php");
    } elseif ($temp == 'about') {
        include("main/about/About.php");
    } elseif ($temp == 'contact') {
        include("main/contact/Contact.php");
    } else {
        include("main/home/Home.php");
    }

    ?>
</div>