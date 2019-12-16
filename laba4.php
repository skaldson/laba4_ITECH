
<?php

 session_start();
 
 $access_login = array();
 $access_passwd = array();
 $access_login = file("login");
 $access_passwd = file("passwd");
 
 $access_login[0] = trim($access_login[0]);
 $access_login[1] = trim($access_login[1]);
 $access_login[2] = trim($access_login[2]);

 $access_passwd[0] = trim($access_passwd[0]);
 $access_passwd[1] = trim($access_passwd[1]);
 $access_passwd[2] = trim($access_passwd[2]);

 $user_data = array_combine($access_login, $access_passwd);
 
 foreach($user_data as $k => $v){
  if ($_POST['enter']){ 
   if($_POST['login'] == $user_data[$k] && $_POST['password'] == $v){
    echo "<script>alert(\"Вы залогинены.\");</script>";
 } 
  else {  
   echo "<script>alert(\"Ошибка, Вы не залогинены.\");</script>";
	   
  }	
}
 
   
} 
?>
