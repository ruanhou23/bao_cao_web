<?php 
ob_start();
    include('../lib/session.php'); 
    Session::checkSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="search-wrapper">
            <span class="ti-search"></span>
            <input type="search" class="search" placeholder="Search">
        </div>
        <div class="social-icons">
            <span class="ti-bell"></span>
            <span class="ti-comment"></span>
            <div></div>
            <span class="user-name">
              <p>Hello <?php echo Session::get('adminName'); ?></p>
            </span>
            <?php 
                // Kiểm tra nếu có tham số 'action' trong URL và có giá trị 'logout'
                if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                    // Chuyển hướng người dùng về trang login.php khi đăng xuất
                    header('Location:login.php');  
                    // Đặt lại trạng thái đăng nhập của người dùng thành false
                    Session::set('adminLogin', false);
                } 
            ?>
            <span class="logout-btn">
                <a href="?action=logout"class="logout__link">
                    Đăng xuất
                </a>
            </span>
        </div>
    </header>
</body>
</html>