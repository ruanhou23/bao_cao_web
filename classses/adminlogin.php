<?php
    $filepath = realpath(dirname(__FILE__));
    include($filepath.'/../lib/session.php');
    Session::checkLogin();
    include($filepath.'/../lib/database.php');
    include($filepath.'/../helpers/format.php');
?>
<?php
    class adminlogin 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser, $adminPass)
        {
            // Kiểm tra xem có chứa từ nào có hợp lệ hay không
            $adminUser = $this->fm->validation($adminUser); 
            $adminPass = $this->fm->validation($adminPass); 

            // Kết nối với cơ sở dữ liệu
            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if (!$adminUser || !$adminPass) {
                echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript:history.go(-1)'>Trở lại</a>";
                echo '<script>alert("Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.");</script>';
                exit;
            }
    
            if (empty($adminUser) || empty($adminPass)) {
                $alert = "Không được để trống";
                echo '<script>alert("Không được để trống.");</script>';
                return $alert;
            } else {
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);

                if ($result) {
                    $value = $result->fetch_assoc();
                    Session::set('adminLogin', true);
                    Session::set('adminId', $value['adminId']);
                    Session::set('adminUser', $value['adminUser']);
                    Session::set('adminName', $value['adminName']);
                    header('Location: index.php'); // Chuyển hướng người dùng đến trang index
                    exit(); // Dừng việc thực hiện mã ngay sau khi chuyển hướng
                } else {
                    $alert = "Mật khẩu hoặc Tài khoản sai";
                    echo '<script>alert("Mật khẩu hoặc Tài khoản sai.");</script>';
                    return $alert;
                }
            }
        }
    }
?>