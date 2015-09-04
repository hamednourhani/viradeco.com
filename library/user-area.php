<?php
/*
* include user registration and profile
 */

?>
<?php
		global $user_errors;
		if( is_wp_error( $user_errors ) ) {
			//echo $userexists->get_error_message();
		}
?>
<div id="container">
    <form method="post" name="registerForm">
        User <input type="text"  name="uname" />
        Email  <input id="email" type="text" name="uemail" />
        Password  <input type="password"  name="upass" />
        <input type="submit" value="Submit" />
    </form>
</div>

<?php var_dump($_POST); ?>