<?php
// include './connect.php';
    if(isset($_POST['user-name']))
    {
        $username=$_POST["user-name"];
        $email=$_POST["email"];
        $address=$_POST["address"];
        $birthday=$_POST["birthday"];
        $phone=$_POST["phone"];
        $CMNDbefore = $_POST["img-id-first"];
        $CMNDafter = $_POST["img-id-after"];
        $error=[];

        if(empty($username))
        {
            $error['username']="Bạn chưa nhập họ và tên";
        }

        if(empty($email))
        {
            $error['email']="Bạn chưa nhập email";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email']="Email bạn nhập không hợp lệ";
        }

        if(empty($address))
        {
            $error['address']="Bạn chưa nhập địa chỉ";
        }

        if(empty($phone))
        {
            $error['phone']="Bạn chưa nhập số đIện thoại";
        }

        if(empty($birthday))
        {
            $error['birthday']="Bạn chưa nhập ngày tháng năm sinh";
        }

        if(empty($CMNDbefore))
        {
            $error['CMNDbefore']="Vui lòng tải ảnh CMND mặt trước";
        }

        if(empty($CMNDafter))
        {
            $error['CMNDafter']="Vui lòng tải ảnh CMND mặt sau";
        }

        $mail="Select * from user where email='$email'";
        $query_email=mysqli_query($conn,$mail);
        $check_email=mysqli_num_rows($query_email);
        
        if($check_email!=0)
        {
            $error['email']='Email này đã được đăng ký'; 
        }

        if(empty($error))
        {
        $sql = "Insert into user(username,address,email,phone,Birthday,Cmndbefore,CmndAfter) Values('$username','$address','$email','$phone','$birthday','$CMNDbefore','$CMNDafter')";
        mysqli_query($conn,$sql);
        $tk=rand(0000000000,9999999999);
        $mk=substr(str_shuffle('abcdefgfhtytrfewdqwdafasfasfadfdafdasfds'), 0, 6);
        $cpr_tk="Select * from users where username = '$tk'";
        $cpr_pwd="Select * from users where username = '$mk'";
        $query_tk=mysqli_query($conn,$cpr_tk);
        $query_mk=mysqli_query($conn,$cpr_pwd);
        $check_tk=mysqli_num_rows($query_tk);
        $check_mk=mysqli_num_rows($query_mk);
        while($check_tk!=0 or $check_mk !=0)
        {
            if($check_tk == 1 and $check_mk == 1)
            {
                $tk=rand(0000000000,9999999999);
                $mk=substr(str_shuffle('abcdefgfhtytrfewdqwdafasfasfadfdafdasfds'), 0, 6);
            }
            elseif($check_tk ==1)
            {
                $tk=rand(0000000000,9999999999);
            }
            else
            {
                $mk=substr(str_shuffle('abcdefgfhtytrfewdqwdafasfasfadfdafdasfds'), 0, 6);
            }
        }
        echo "Tai khoan cua bạn là: ".$tk." Mật khẩu của bạn là: ".$mk;

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7b78e77d77.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <a class="navbar-brand" href="#">
            <i class="fa fa-building"></i>
            <h1 class="navbar-symbol">PPS bank</h1>
        </a>
      
       
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link login" href="#">Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link signup active" href="#">Đăng kí</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Xem Thêm
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Thông tin ngân hàng</a>
              <a class="dropdown-item" href="#">Quyền lợi khách hàng</a>
              <a class="dropdown-item" href="#">Hỏi & Đáp</a>
            </div>
          </li>
        </ul>
      </nav>
    
      <form action="register.php" method="POST" role="form">
            <div class="container w-100">
            <h2 class="text-center">Đăng ký thành viên mới </h2>
            <div class="form-group">
                <label for="usr" style="cursor: pointer;">Họ và tên <span style="color:red;">(*)</span></label>
                <input name="user-name" id="usr" type="text" class="form-control w-100">
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['username']))?$error['username']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="email" style="cursor: pointer;">Email <span style="color:red;">(*)</span></label>
                <input name="email" id="email" type="email" class="form-control w-100">
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['email']))?$error['email']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="address" style="cursor: pointer;">Địa chỉ <span style="color:red;">(*)</span></label>
                <input name="address" id="address" type="text" class="form-control w-100">
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['address']))?$error['address']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="birthday" style="cursor: pointer;">Ngày tháng năm sinh <span style="color:red;">(*)</span></label>
                <input name="birthday" id="birthday" type="date" class="form-control w-100">
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['birthday']))?$error['birthday']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" style="cursor: pointer;">Số điện thoại <span style="color:red;">(*)</span></label>
                <input name="phone" id="phone" type="tel" class="form-control w-100">
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['phone']))?$error['phone']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="file" style="cursor: pointer;">Upload CMND mặt trước</label>
                <input type="file" onchange="loadFile(event)" class="form-control-file" id="file" name="img-id-first" accept="image/*">
                <img class="img-thumbnail w-25" id="output" width="200"/>
                <script>
                    var loadFile = function(event) {
	                var image = document.getElementById('output');
	                image.src = URL.createObjectURL(event.target.files[0]);
                    };
                </script>
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['CMNDbefore']))?$error['CMNDbefore']:"" ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="file" style="cursor: pointer;">Upload CMND mặt sau</label>
                <input type="file" onchange="loadFile(event)" class="form-control-file" id="file" name="img-id-after" accept="image/*">
                <img class="img-thumbnail w-25" id="output"/>
                <script>
                    var loadFile = function(event) {
	                var image = document.getElementById('output');
	                image.src = URL.createObjectURL(event.target.files[0]);
                   };
                </script>
                <div class="has-error">
                    <span class="text-danger"> <?php echo(isset($error['CMNDafter']))?$error['CMNDafter']:"" ?></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 pr-5">
                    <button type="submit" class="btn btn_custom" >Đăng ký ngay</button>
                    <h4 class='sub-desc'>Đã có tài khoản ? <a href="./login.html">Đăng nhập</a></h4>
                </div>                       
            </div>
        </div>
    </form>
    <footer class="footer bg-dark text-white"><h4 class="footer-font"> ©Bản quyền thuộc về Phát - Phúc - Sơn</h4></footer>
</body>
</html>