<?php
    session_start();
    require_once "settings/system.php";
    $captha = random_number();
    $_SESSION['captha'] = $captha;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Гостевая книга</title>
</head>
<body>
    <div class="container">
        <div class="headerType">
            <p class="headerText">Гостевая книга</p>
            <script>
                setTimeout(function(){
                    document.getElementById('warning').style.display = 'none';
                }, 5000);
            </script>
            <form action="" method="POST">
                <input type="text" name="promo" placeholder="Промокод">
                <?php 
                    if(isset($_SESSION['token'])){
                        $unsit = $_SESSION['token'];
                        if($unsit != ""){
                            echo "  <form action='index.php' method='post' class='exit'>
                                        <input type='submit' value='Выход' name='exit'>
                                    </form>";
                        }
                    }
                ?>
                <?php
                    if(isset($_POST['exit']))
                    {
                        unset($_SESSION["phone"]);
                        unset($_SESSION["id"]);
                        session_destroy();
                        exit("<meta http-equiv='refresh' content='0; url= index.php'>");
                    }
                ?>
            </form>
            <?php 
                if(isset($_POST['promo']))
                {
                    $promo = htmlentities(strip_tags(OnCoding($_POST['promo'])));
                    require_once "settings/connect.php";
                    $db_server = mysqli_connect($db_hostname , $db_username , $db_password, $db_database) or die (mysqli_connect_error());
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($db_server, $query);
                    if(!$result) die ("Сбой при доступе к базе данных: " . mysqli_error($db_server));
                    $query = "SELECT * FROM `users` WHERE promo = '$promo';";
                    $result = mysqli_query($db_server, $query) or die ("Ошибка в запросе: " . mysqli_error($db_server));
                    if (mysqli_num_rows($result) > 0)
                    {
                        $unsit = "admininsite";
                        $_SESSION['token'] = $unsit;
                        mysqli_close($db_server);
                        exit("<meta http-equiv='refresh' content='0; url= index.php'>");
                    }
                }
            
            ?>
        </div>
        <table>
            <thead>
                <thead>
                    <td><?php echo sort_link_th('Имя пользователя', 'username_asc', 'username_desc'); ?></td>
                    <td><?php echo sort_link_th('Почта', 'email_asc', 'email_desc'); ?></td>
                    <td>Сообщение</td>
                    <td><?php echo sort_link_th('Дата и время', 'date_asc', 'date_desc'); ?></td>
                </thead>
            </thead>
            <tbody>
                <?php
                    require_once "settings/connect.php";
                    $limit = 5;
                    $result = mysqli_query($db_server, "SELECT COUNT(*) as count FROM message");
                    $row = mysqli_fetch_assoc($result);
                    $total_records = $row['count'];
                    $total_pages = ceil($total_records / $limit);
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    if ($current_page < 1) {
                        $current_page = 1;
                    } elseif ($current_page > $total_pages) {
                        $current_page = $total_pages;
                    }
                    $offset = ($current_page - 1) * $limit;
                    $query = "SELECT * FROM message ORDER BY {$sort_sql} LIMIT $limit OFFSET $offset";
                    $result = mysqli_query($db_server, $query);
                    if(!$result) die ('Сбой при доступе к базе данных: ' . mysqli_error($db_server));
                    $unsit = "";
                    if(isset($_SESSION['token'])){
                        $unsit = $_SESSION['token'];
                    }
                    if($unsit == ""){
                        if(mysqli_num_rows($result)>0) {
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                echo 
                                    "<tr>
                                        <td>" . $row['username'] . "</td>
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $row['description'] . "</td>
                                        <td>" . date("d.m.Y H:i:s", $row['date']) . "</td>
                                    </tr>";
                            }
                        }
                    }
                    else{
                        if(mysqli_num_rows($result)>0) {
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                            {
                                echo 
                                    "<tr>
                                        <td>" . $row['username'] . "</td>
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $row['description'] . "</td>
                                        <td>" . date("d.m.Y H:i:s", $row['date']) . "</td>
                                        <td>" . $row['ip'] . "</td>
                                        <td>" . $row['browser'] . "</td>
                                        <td>
                                            <form action = '' method = 'post'>
                                                <input type = 'hidden' name = 'delete1' value = 'yes'>
                                                <input type = 'hidden' name = 'id' value = '".$row['id']."'>
                                                <input type = 'submit' value = 'X' class='delete'>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        }
                    }
                    if(isset($_POST["delete1"]) && isset($_POST["id"]))
                    {
                        $id = $_POST["id"];
                        $query = "DELETE FROM message WHERE `id` = '$id'";
                        $result = mysqli_query($db_server, $query)
                        or die ("Ошибкa в зanpoce: " . mysqli_error($db_server));
                        exit("<meta http-equiv='refresh' content='0; url= index.php'>");
                    }
                ?>
                
            </tbody>  
        </table>

        <div class="pagination">
            <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    $sort_param = isset($_GET['sort']) ? '&sort=' . htmlspecialchars($sort) : '';
                    if ($i == $current_page) {
                        echo "<strong>$i</strong> ";
                    } else {
                        echo "<a href='?page=$i$sort_param'>$i</a> ";
                    }
                }
            ?>
        </div>

        <form action="" class="form" method="POST">
            <p>Оставить запись в гостевой книге</p>
            <input type="text" name="username" placeholder="Логин" required>
            <input type="email" name="email" placeholder="Почта" required>
            <br>
            <textarea name="description" class="description" placeholder="Сообщение" required></textarea>
            <p class="infotext">Капча: <?echo $_SESSION['captha']?></p>
            <input type="hidden" name="getCaptcha" value="<?echo $_SESSION['captha']?>">
            <input type="text" name="captcha" placeholder="Капча" required>
            <input type="submit" value="Отправить" name="but" class="but">
        </form>

        <?php
            require_once "settings/connect.php";
            $query = "SELECT * FROM message";
            $result = mysqli_query($db_server, $query);
            if(!$result) die ("Сбой при доступе к базе данных: " . mysqli_error($db_server));

            if(isset($_POST["but"]) &&
            isset($_POST["username"]) &&
            isset($_POST["email"]) &&
            isset($_POST["description"]) &&
            isset($_POST["captcha"])) 
            {
                $capthaCheak = $_POST["captcha"];
                $captcha = $_POST["getCaptcha"];

                if($captcha == $capthaCheak)
                {
                    $username = htmlentities(strip_tags($_POST["username"]));
                    $email = htmlentities(strip_tags($_POST["email"]));
                    $description = htmlentities(strip_tags($_POST["description"]));
        
                    if($username && $email && $description)
                    {
                        if(preg_match('/^[a-zA-Z0-9]+$/', $username)){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                require_once "settings/system.php";
                                $ip = getClientIP();
                                $browser = getClientBrowser();
                                $date = time();
                                $query = "INSERT INTO message VALUES" . "(NULL, '$username', '$email', '$description', '$date', '$ip', '$browser')";
                                $result = mysqli_query($db_server, $query) or die ("Ошибка в запросе: " . mysqli_error($db_server));
                                mysqli_close($db_server);
                                exit("<meta http-equiv='refresh' content='0; url= index.php'>");
                            }
                            else{
                                mysqli_close($db_server);
                                echo "<div class='warning' id='warning'>
                                        <p>Некорректный формат E-mail.</p>
                                    </div>";
                                exit();
                            }
                        }
                        else{
                            mysqli_close($db_server);
                            echo "<div class='warning' id='warning'>
                                    <p>Имя пользователя должно состоять из цифр и букв латинского алфавита.</p>
                                </div>";
                            exit();
                        }
                    }
                    else
                    {
                        mysqli_close($db_server);
                        echo "<div class='warning' id='warning'>
                                <p>Не все поля были заполнены</p>
                            </div>";
                        exit();
                    }
                }
                else{
                    mysqli_close($db_server);
                    echo "  <div class='warning' id='warning'>
                                <p>Капча введена неверно</p>
                            </div>";
                    exit();
                }
            }
            mysqli_close($db_server);
            exit();
        ?>

    </div>
</body>
</html>