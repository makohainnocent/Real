<?php
session_start();
require("db_config.php");

if (empty($_POST['email']) or empty($_POST['pass'])) {
    header('location:index.php?error=1');
}
else {
    echo "Gotten values ".$_POST['email']." ".$_POST['pass'];

    $email=clean($_POST['email']);
    $password=clean($_POST['pass']);
    
    $sql="SELECT id,company_name FROM users WHERE email='$email' AND password='$password'";
    $query=@mysqli_query($conn,$sql);
    
    if($query){
        
        if(mysqli_num_rows($query)==1){

            $row=mysqli_fetch_assoc($query);
            $_SESSION['id']=$row['id'];
            $_SESSION['company_name']=$row['company_name'];
            header('location:estate/screens/view_estates.php');
        }
        else{
           header('location:index.php?error=2');
        }
        
    }
    else{
        header('location:index.php');
    }


}
?>