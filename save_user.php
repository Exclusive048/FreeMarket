<?php header('Content-Type: text/html; charset=utf-8');?>
<?php
    if (isset($_POST['email'])) 
    {
        $email = $_POST['email'];
        if ($email == '') 
        {
            unset($email);
        } 
    } 
    
    if (isset($_POST['password'])) 
        {
            $password=$_POST['password']; 
            if ($password =='') 
                {
                    unset($password);
                }
        }

        if (isset($_POST['password2'])) 
        {
            $password2=$_POST['password2']; 
            if ($password2 =='') 
                {
                    unset($password2);
                }
        }

        if (isset($_POST['Fio'])) 
        {
            $Fio=$_POST['Fio']; 
            if ($Fio =='') 
                {
                    unset($Fio);
                }
        }
    if (empty($email) or empty($password) or empty($password2))
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    if ($password != $password2)
    {
    exit ("Пароли не совпадают!");
    }
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $password2 = stripslashes($password2);
    $password2 = htmlspecialchars($password2);
    $Fio = stripslashes($Fio);
    $Fio = htmlspecialchars($Fio);

    $email = trim($email);
    $password = trim($password);

    include ("bd.php");

    $result = mysql_query("SELECT * FROM user WHERE email_user='$email'",$db);
    $myrow = @mysql_fetch_array($result);

    if(strnatcmp($myrow['email_user'],$email)==0)
    {
        exit ("Извините, аккаунт с данным почтовым адресом уже существует!");
    }
    $result2 = mysql_query ("INSERT INTO user (fio_user,email_user,pass_user) VALUES('$Fio','$email','$password')");

    if ($result2=='TRUE')
    {
    header('Location: http://localhost/index.php');
    }
 else 
 {
    echo "Ошибка! Вы не зарегистрированы.";
    }
?>