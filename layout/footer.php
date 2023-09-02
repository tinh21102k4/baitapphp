<?php

    if(isset($_POST['btnform'])) {
       $email = $_POST['email'];
       $error = '';
       $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
       if(empty($email)) {
           $error = 'Không được để trống email';
       }
       elseif (!preg_match($pattern, $email)) {
           $error = 'Email vừa nhập không hợp lệ';
       }
       else{
           $error = 'Chúng tôi sẽ liên hệ sau';
       }
    }
?>
<footer>
    <div class="container_footer">
        <div class="contact_web">
            <h4>Thông tin liên lạc</h4>
            <div class="image_logo">
                <img src="./image/logo_fpt.png" alt="" srcset="">
            </div>
            <p>Số điện thoại : 0394562068</p>
            <p>Email : tinhhdph43108@fpt.edu.vn</p>
        </div>
        <div class="form_footer">
            <h4>Mời bạn nhập email để liên hệ</h4>
            <span>Chúng tôi rất vui vì được hợp tác với bạn</span>
            <div class="form_footer_gap">
                <form action="" method="post">
                    <input class="form_input_footer" type="email" name="email" placeholder="Email">
                    <strong><?php if(isset($error)) {
                        echo $error;
                        } ?></strong>
                    </br>
                    <input class="form_input_sub" type="submit" name="btnform" value="Submit">
                </form>
            </div>
        </div>
    </div>
</footer>