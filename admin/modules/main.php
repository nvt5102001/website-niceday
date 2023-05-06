<?php

    if(isset($_GET['action']) && $_GET['query']){
        $tam = $_GET['action'];
        $query = $_GET['query'];
    }else{
        $tam = '';
        $query = '';
    }
    // Main quản lý loại sản phẩm
    if($tam=='categoryManagement' && $query=='insert')
    {
        include("modules/categoryManagement/insert.php");
        
    }
    elseif ($tam =='categoryManagement' && $query=='update') 
    {
        include("modules/categoryManagement/update.php");
    }
    elseif ($tam =='categoryManagement' && $query=='select') 
    {
        include("modules/categoryManagement/select.php");
    }

    
    // Main quản lý sản phẩm
    elseif ($tam=='productManagement' && $query=='insert') 
    {
        include("modules/productManagement/insert.php");
    }
    elseif ($tam=='productManagement' && $query=='select') 
    {
        include("modules/productManagement/select.php");
    }
    elseif($tam=='productManagement' && $query=='update')
    {
        include("modules/productManagement/update.php");
    }
    elseif($tam=='productManagement' && $query=='search')
    {
        include("modules/productManagement/search.php");
    }

    // Main quản lý thương hiệu
    elseif ($tam=='brandManagement' && $query=='select') 
    {
        include("modules/brandManagement/select.php");
    }
    elseif ($tam=='brandManagement' && $query=='insert') 
    {
        include("modules/brandManagement/insert.php");
    }
    elseif($tam=='brandManagement' && $query=='update')
    {
        include("modules/brandManagement/update.php");
    }

    // Main quản lý màu sắc
    elseif ($tam=='colorManagement' && $query=='select') 
    {
        include("modules/colorManagement/select.php");
    }
    elseif ($tam=='colorManagement' && $query=='insert') 
    {
        include("modules/colorManagement/insert.php");
    }
    elseif($tam=='colorManagement' && $query=='update')
    {
        include("modules/colorManagement/update.php");
    }

    // Main quản lý kiểu dáng
    elseif ($tam=='styleManagement' && $query=='select') 
    {
        include("modules/styleManagement/select.php");
    }
    elseif ($tam=='styleManagement' && $query=='insert') 
    {
        include("modules/styleManagement/insert.php");
    }
    elseif($tam=='styleManagement' && $query=='update')
    {
        include("modules/styleManagement/update.php");
    }
    
    // Main quản lý đơn bán
    elseif($tam=='orderManagement' && $query=='select')
    {
        include("modules/orderManagement/select.php");
    }
    elseif($tam=='orderManagement' && $query=='search')
    {
        include("modules/orderManagement/search.php");
    }
    elseif($tam=='donhang' && $query=='detail')
    {
        include("modules/orderManagement/detail.php");
    }

    // Main quản lý tài khoản
    elseif($tam=='quanlytaikhoan' && $query=='insert')
    {
        include("modules/accountManagement/insert.php");
    }
    elseif($tam=='quanlytaikhoan' && $query=='select')
    {
        include("modules/accountManagement/select.php");
    }
    elseif($tam=='quanlytaikhoan' && $query=='search')
    {
        include("modules/accountManagement/search.php");
    }

    // Main quản lý bài viết
    elseif($tam=='blogManagement' && $query=='insert')
    {
        include("modules/blogManagement/insert.php");
    }
    elseif($tam=='blogManagement' && $query=='update')
    {
        include("modules/blogManagement/update.php");
    }
    elseif($tam=='blogManagement' && $query=='select')
    {
        include("modules/blogManagement/select.php");
    }

    // Main quản lý nhập kho
    elseif($tam=='warehouseManagement' && $query=='select')
    {
        include("modules/warehouseManagement/select.php");
    }
    elseif($tam=='warehouseManagement' && $query=='insertDetail')
    {
        include("modules/warehouseManagement/insertDetail.php");
    }
    elseif($tam=='warehouseManagement' && $query=='search')
    {
        include("modules/warehouseManagement/search.php");
    }
    elseif($tam=='warehouseManagement' && $query=='searchStatus')
    {
        include("modules/warehouseManagement/searchStatus.php");
    }
    elseif($tam=='warehouseManagement' && $query=='checkSP')
    {
        include("modules/warehouseManagement/checkSP.php");
    }
    elseif($tam=='warehouseManagement' && $query=='detail')
    {
        include("modules/warehouseManagement/detail.php");
    }
   
    
    // Main quản lý dashboard
    else
    {
        include("modules/dashboard.php");
    }
