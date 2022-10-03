<?php
session_start();
require "./lib/php/connect.php";
?>
<!DOCTYPE html>
<html lang="vi-VN" class="no-js">

<head>
    <meta charset="UTF-8">
    <title>Phượt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./lib/images/favicon.png">
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./lib/css/main.css">
    <script src="./lib/js/main.js"></script>
</head>

<body>
    <div class="body">
        <header class="header">
            <div class="logo">
                <a href="./index.php"><img class="img" src="./lib/images/cdlncd.png" /></a>
                <form method="get">
                    <div class="search-group">
                        <input class="search" type="text" name="find" placeholder="Tìm kiếm" />
                        <button type="submit" name="go" class="search-btn"><img src="./lib/images/search_icon.png"></button>
                    </div>
                    <?php
                    if (isset($_GET['go'])) {
                        $content = $_GET['find'];
                        echo "<meta http-equiv='refresh' content='0;url=./search.php?search-content=" . $content . "&type=0&search' />";
                    }
                    ?>
                </form>
            </div>
            <nav id="menu">
                <div>
                    <marquee behavior="scroll" direction="left">
                        Cuộc Đời Là Những Chuyến Đi
                    </marquee>
                </div>

                <?php

                if (!isset($_SESSION['userID'])) {
                    echo "<ul><li class='effect gr-i-m ef open-login' id='login'>Đăng nhập</li>";
                    echo "<li class='effect gr-i-m ef open-reg' id='reg'>Đăng ký</li>
                        </ul>";
                }
                ?>
            </nav>
            <div class="menu-toggle">
                <div>
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
        </header>
        <div class="full-s-menu" id="full-menu">
            <nav id="item">
                <ul><?php
                    if (!isset($_SESSION['userID'])) {
                        echo "<li class='log'>
                        <a class='open-login'>Đăng nhập</a></li>
                        <li class='log'>
                        <a class='open-reg'>Đăng ký</a></li>";
                    }
                    ?>
                    <li>
                        <a href="./index.php">Trang chủ</a></li>
                    <li>
                        <a href="./profile.php">Hồ sơ cá nhân</a></li>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        $user_id = $_SESSION['userID'];
                        $sql = "SELECT * FROM users WHERE user_name = '$user_id'";
                        $re = $con->query($sql)->fetch_assoc();
                        if ($re['chucvu'] === 'Admin') {
                            echo "<li>
                            <a href='./admin.php'>Quản lý</a></li>";
                        }
                    }
                    ?>
                    <li>
                        <a href="./weather.html">Thời tiết</a></li>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        echo "
                            <li>
                                <a href='index.php?logout'>Đăng xuất</a></li>";
                    }
                    if (isset($_GET['logout']) && isset($_SESSION['userID'])) {
                        unset($_SESSION['userID']);
                        header('Location: ./index.php');
                    }
                    ?>

                </ul>
            </nav>
        </div>
        <?php
        if (!isset($_SESSION['userID'])) {
            echo   "<div class='modal-reg'>
        <div class='modal-content'>
            <span class='close'>&times;</span>
            <header class='text-center mb-4'>
                <h1>Đăng ký</h1>
            </header>
            <form method='post'>
                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='name'>Họ tên(*):</label>
                        <input class='form-control' type='text' id='name' name='fullName' aria-describedby='err' required />
                        <small class='text-danger' id='err'></small>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='user-name'>Tên đăng nhập(*):</label>
                        <input class='form-control' type='text' id='user-name' name='userName' aria-describedby='err1' required />
                        <small class='text-danger' id='err1'></small>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-group col-md-6'>
                        <label for='pwd'>Mật khẩu(*): </label>
                        <input class='form-control' type='password' id='pwd' name='pwd' aria-describedby='err3' required />
                        <small class='text-danger' id='err3'></small>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='rpwd'>Nhập lại mật khẩu(*): </label>
                        <input class='form-control' type='password' id='rpwd' aria-describedby='err2' required />
                        <small class='text-danger' id='err2'></small>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-md-12'>
                        <label for='tele'>Số điện thoại(*):</label>
                        <input class='form-control' type='text' id='tele' name='tel' required>
                        <small class='text-danger' id='err4'></small>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group m-auto'>
                        <input class='btn btn-primary mt-4 mb-3' type='submit' name='reg' value='Đăng ký'>
                    </div>
                </div>
            </form>
        </div> 
    </div>";
            echo "<div class='modal-login'>
                <div class='modal-content'>
                    <span class='close'>&times;</span>
                    <header class='text-center mb-4'>
                        <h1>Đăng nhập</h1>
                    </header>
                    <form method='post'>
                        <div class='form-row'>
                            <div class='form-group col-md-12'>
                                <label for='user-name-log'>Tên đăng nhập(*):</label>
                                <input class='form-control' type='text' id='user-name-log' name='userNameLog' aria-describedby='err1-log' required />
                                <small class='text-danger' id='err1-log'></small>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group col-md-12'>
                                <label for='pwd-log'>Mật khẩu(*): </label>
                                <input class='form-control' type='password' id='pwd-log' name='pwdLog' aria-describedby='err3-log' required />
                                <small class='text-danger' id='err3-log'></small>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-group m-auto'>
                                <input class='btn btn-primary mt-4 mb-3' type='submit' name='log' value='Đăng nhập'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>";

            if (isset($_POST['reg'])) {
                $fname = isset($_POST['fullName']) ? $_POST['fullName'] : "";
                $uname = isset($_POST['userName']) ? $_POST['userName'] : "";
                $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
                $tel = isset($_POST['tel']) ? $_POST['tel'] : "";
                $sql = "INSERT INTO users(user_name, pass, hoten, sodienthoai) VALUES('$uname', '$pwd', '$fname', '$tel')";

                if ($con->query($sql)) {
                    echo "<script type='text/javascript'>window.alert('Đăng ký thành công.');</script>";
                } else {
                    echo "<script type='text/javascript'>window.alert('Tài khoản đã tồn tại.');</script>";
                }
            }

            if (isset($_POST['log'])) {
                $uname = isset($_POST['userNameLog']) ? $_POST['userNameLog'] : "";
                $pwd = isset($_POST['pwdLog']) ? $_POST['pwdLog'] : "";
                $sql = "SELECT * FROM users WHERE user_name = '$uname'";
                $row = $con->query($sql)->fetch_assoc();

                if (isset($row['user_name']) && $row['user_name'] === $uname && $row['pass'] === $pwd) {
                    $_SESSION['userID'] = $uname;
                    echo "<script type='text/javascript'>window.alert('Đăng nhập thành công.')</script>";
                    echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    echo "<script type='text/javascript'>window.alert('Sai tài khoản hoặc mật khẩu.');</script>";
                }
            }
        }

        ?>

        <div class="main">
            <div class="left">
                <div class="info">
                    <div class="info-top"><a href="./profile.php">Hồ sơ cá nhân</a></div>
                    <div class="thongbao">
                        <div class="tb">Thông báo</div>
                        <div class="notify">
                            <div class="notify-content">...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <div class="name group-name">Bắc</div>
                    <div class="pl-1">
                        <?php
                        $sql = "SELECT * FROM posts WHERE nhom = 'Bắc' ORDER BY post_id DESC LIMIT 0,3";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div><a href='./post.php?id=" . $row['post_id'] . "'>" . $row['title'] . "</a>
                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="group">
                    <div class="name group-name">Trung</div>
                    <div class="pl-1">
                        <?php
                        $sql = "SELECT * FROM posts WHERE nhom = 'Trung' ORDER BY post_id DESC LIMIT 0,3";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div><a href='./post.php?id=" . $row['post_id'] . "'>" . $row['title'] . "</a>
                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="group">
                    <div class="name group-name">Nam</div>
                    <div class="pl-1">
                        <?php
                        $sql = "SELECT * FROM posts WHERE nhom = 'Nam' ORDER BY post_id DESC LIMIT 0,3";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div><a href='./post.php?id=" . $row['post_id'] . "'>" . $row['title'] . "</a>
                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="right">
                <?php
                if (isset($_SESSION['userID'])) {
                    $userID = $_SESSION['userID'];
                    $sql = "SELECT * FROM users WHERE user_name = '$userID'";
                    $post = "SELECT COUNT(post_id) AS total_post FROM posts WHERE user_name = '$userID'";
                    $re_post = $con->query($post);
                    $re = $con->query($sql);
                    if ($re->num_rows > 0) {
                        $row = $re->fetch_assoc();
                        echo "<div class='content'>
                    <div class='mt-0 ml-2'>
                    <div class=' c-header'>
                        <img class='avt-profile' src='./lib/images/default_avatar.png'>
                        <div>
                        <div class='name'>" . $row['hoten'] . "</div>";
                        if ($re_post->num_rows > 0) {
                            $r = $re_post->fetch_assoc();
                            echo "<p class='pl-2 mb-0'>Bài viết: " . $r['total_post'] . "</p>";
                        }
                        echo "<p class='pl-2 mb-0'>Giới tính: " . $row['gioitinh'] . "</p>";
                        echo "<p class='pl-2 mb-0'>Ngày sinh: " . $row['ngaysinh'] . "</p>";
                        echo "<p class='pl-2 mb-0'>Số điện thoại: " . $row['sodienthoai'] . "</p>";
                        echo "<p class='pl-2 mb-0'>Sở thích: " . $row['sothich'] . "</p>";

                        echo "</div></div>
                        </div></div>";
                        $nam = $row['gioitinh'] == 'Nam' ? 'selected' : '';
                        $nu = $row['gioitinh'] == 'Nữ' ? 'selected' : '';
                        echo "<div class='content'>
                        <div><form method='post'>
                        <div class='form-group p-1'>
                        <table>
                            <tr>
                                <td>
                                <label for='hoten'>Họ tên:</label></td>
                                <td>
                                <input type='text' class='form-control f-sm mb-1' name='hoten' id='hoten' value='" . $row['hoten'] . "' /></td>
                            </tr>
                            <tr>
                                <td><label for='gioitinh'>Giới tính:</label></td>
                                <td><select id='gioitinh' class='form-control f-sm mb-1' name='gioitinh'>
                                <option value=''>Khác</option>
                                <option value='Nam' " . $nam . ">Nam</option>
                                <option value='Nữ' " . $nu . ">Nữ</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td><label for='ngaysinh'>Ngày sinh:</label></td>
                                <td><input type='date' class='form-control f-sm mb-1' name='ngaysinh' id='ngaysinh' value='" . $row['ngaysinh'] . "' /></td>
                            </tr>
                            <tr>
                                <td>
                                <label for='sdt'>Số điện thoại:</label></td>
                                <td>
                                <input type='text' class='form-control f-sm mb-1' name='sdt' id='sdt' value='" . $row['sodienthoai'] . "' /></td>
                            </tr>
                            <tr>
                                <td><label for='sothich'>Sở thích:</label></td>
                                <td><textarea class='form-control f-sm' name='sothich' id='sothich' />" . $row['sothich'] . "</textarea></td>
                            </tr>
                        </table>
                        <button class='f-sm btn btn-success' name='save'>Lưu</button>
                        </div></form></div>
                        </div>";
                    }


                    if (isset($_POST['save'])) {
                        $ht = $_POST['hoten'];
                        $gt = $_POST['gioitinh'];
                        $ns = $_POST['ngaysinh'] == '' ? 'null' : $_POST['ngaysinh'];
                        $sdt = $_POST['sdt'];
                        $st = $_POST['sothich'];

                        $isnull = $con->query("UPDATE users SET hoten = '$ht', gioitinh = '$gt', ngaysinh = $ns, sodienthoai = '$sdt', sothich = '$st' WHERE user_name = '$userID'");
                        $notnull = $con->query("UPDATE users SET hoten = '$ht', gioitinh = '$gt', ngaysinh = '$ns', sodienthoai = '$sdt', sothich = '$st' WHERE user_name = '$userID'");
                        if ($ns == 'null' ? $isnull : $notnull) {
                            echo "<meta http-equiv='refresh' content='0'>";
                        } else echo $con->error;
                    }
                }

                ?>
            </div>

        </div>
        <footer id="ft">
            <div class="top animated"></div>
            <div class="bot">
                <div>Run For Your Life</div>

            </div>
        </footer>


    </div>
</body>

</html>