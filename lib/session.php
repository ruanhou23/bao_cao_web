<?php
/**
*Session Class
**/
// thêm giỏ hàng , thanh toan , đăng nhập đảm nhiệm những chức năng này , lưu phiên giao dịch khi làm mới trang
class Session{
    /**Khởi tạo phiên (session) trong ứng dụng PHP dựa trên phiên bản PHP */
    public static function init(){
        // Kiểm tra phiên bản PHP để quyết định cách khởi động session
        if (version_compare(phpversion(), '5.4.0', '<')) {
            // Nếu phiên bản PHP dưới 5.4.0, kiểm tra xem session_id có tồn tại không và bắt đầu session nếu không tồn tại
            if (session_id() == '') {
                session_start();
            }
        } else {
            // Nếu phiên bản PHP từ 5.4.0 trở lên, kiểm tra xem session_status có PHP_SESSION_NONE không và bắt đầu session nếu có
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }
    /** Thiết lập giá trị cho một key trong biến toàn cục $_SESSION */
    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }
 /**Kiểm tra phiên session của người dùng để xác thực trạng thái đăng nhập */
 public static function checkSession(){
    self::init(); // Khởi tạo session
    if (self::get("adminLogin") == false) { // Kiểm tra session 'adminLogin'
        self::destroy(); // Xóa session
        header("Location: login.php"); // Chuyển hướng người dùng đến trang đăng nhập
        exit(); // Dừng việc thực hiện mã ngay sau khi chuyển hướng
    }
}
 public static function checkLogin(){
    self::init();
    if (self::get("adminLogin")== true) {
     header("Location:index.php");
    }
 }
public static function destroy(){
  session_destroy();
}
}
?>