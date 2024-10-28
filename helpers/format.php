<?php
/**
* Format Class
*/
    class Format{
        /*** Định dạng lại ngày tháng*/
        public function formatDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }

       /*** Rút ngắn đoạn văn bản đến một độ dài nhất định và thêm dấu chấm cuối cùng*/
        public function textShorten($text, $limit = 400){
            $text = $text. " "; // Thêm một khoảng trắng vào cuối đoạn văn bản để đảm bảo không bị cắt đoạn từ giữa từ
            $text = substr($text, 0, $limit); // Cắt đoạn văn bản đến độ dài tối đa cho phép
            $text = substr($text, 0, strrpos($text, ' ')); // Cắt đến vị trí khoảng trắng gần nhất để không cắt từ giữa
            $text = $text."....."; // Thêm dấu chấm cuối cùng để chỉ ra việc văn bản đã bị cắt ngắn
            return $text; // Trả về đoạn văn bản đã rút ngắn
        }

        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path, '.php');
            //$title = str_replace('_', ' ', $title);
            if ($title == 'index') {
            $title = 'home';
            }elseif ($title == 'contact') {
            $title = 'contact';
            }
            return $title = ucfirst($title);
        }
    }
?>
