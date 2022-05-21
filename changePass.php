<?php
    include './connect.php';
    if (isset($_SESSION['username'])==false)
    {
        header('Location: ./login.php');
        exit();
    }
    $username=$_SESSION['username'];
    $err=[];
    if (isset($_POST['btndoimatkhau'])==true)
    {
        $oldp = $_POST['oldp'];
        $newpass = $_POST['newpass'];
        $confirmpass = $_POST['confirmpass'];
        $sql="Select * from login where username = '$username'";
        $result= $conn->query($sql);
        $data = $result->fetch_assoc();
        if ($oldp != $data['password'])
        {
            $err['oldp']="Mật khẩu cũ sai";
        }
        if (strlen($newpass)<6)
        {
            $err['newpass']="Mật khẩu quá ngắn";
        }
        if ($confirmpass!=$newpass)
        {
            $err['confirmpass']="Mật khẩu không khớp";
        }
        if (empty($err))
        {
            $sql="update login set password = '$newpass' where  username = '$username'";
            mysqli_query($conn,$sql);
            header('Location: ./homePage.php');
            exit();
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
        <h1 class="navbar-symbol">PPS Bank</h1>
    </a>
    <ul class="navbar-nav menuItems mb-5">
        <li class="nav-item">
            <a class="nav-link signup" href="./register.php">Đăng kí</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Xem Thêm
            </a>
            <div class="dropdown-menu ">
                <a class="dropdown-item" href="#">Thông tin ngân hàng</a>
                <a class="dropdown-item" href="#">Quyền lợi khách hàng</a>
                <a class="dropdown-item" href="#">Hỏi & Đáp</a>
            </div>
        </li>
    </ul>
    <i class="fa fa-bars text-white menu-icon" onclick="Handle()"></i>
</nav>

<form  action="" method="POST" role="form">
    <div class="container">
        <h4 class="mb-5 text-center text-danger">Bạn phải đổi mật khẩu để tiếp tục</h4>
        <div class="form-group input-items">
            <i class="fa fa-lock"></i>
            <label for="oldp" style="cursor: pointer;">Mật khẩu Cũ</label>
            <input name="oldp" id="oldp" type="password" class="form-control  w-75" placeholder="Old Password"/>
            <div class="has-err">
                <span class="text-danger"><?php echo(isset($err['oldp']))?$err['oldp']:"" ?></span>
            </div>
        </div>
        <div class="form-group input-items">
            <i class="fa fa-lock"></i>
            <label for="newpass" style="cursor: pointer;">Mật khẩu mới</label>
            <input name="newpass" id="newpass" type="password" class="form-control  w-75" placeholder="New Password"/>
            <div class="has-err">
                <span class="text-danger"><?php echo(isset($err['newpass']))?$err['newpass']:"" ?></span>
            </div>
        </div>
        <div class="form-group input-items">
            <i class="fa fa-key"></i>
            <label for="confirmpass" style="cursor: pointer;">Xác nhận mật khẩu</label>
            <input name="confirmpass" id="confirmpass" type="password" class="form-control  w-75" placeholder="Confirm Password"/>
            <div class="has-err">
                <span class="text-danger"><?php echo(isset($err['confirmpass']))?$err['confirmpass']:"" ?></span>
            </div>
        </div>

        <div class="row btn_groups">
            <div class="col-sm-12 pr-5 input-items">
                <button type='submit' name="btndoimatkhau" value="doimatkhau"  class="btn btn-primary">Đổi Mật Khẩu</button>
            </div>
        </div>
    </div>
</form>
<footer class="footer bg-dark text-white"><h4 class="footer-font"> ©Bản quyền thuộc về Phát - Phúc - Sơn</h4></footer>
</body>
<script src="./main.js"></script>

</html>
