<?php
//Redefine user notification function
	function viradeco_new_user_notification($user_id, $plaintext_pass = '') {
	        $user = get_userdata( $user_id );
	
	        $user_login = stripslashes($user->user_login);
	        $user_email = stripslashes($user->user_email);
	        $viraclub_id = get_user_meta( $user_id, 'viraclub', 1 );
	        $viraclub_id = ($viraclub_id)?($viraclub_id):"";
	
	        // The blogname option is escaped with esc_html on the way into the database in sanitize_option
	        // we want to reverse this for the plain text arena of emails.
	        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	
	        $message  = sprintf(__('New user registration in %s:','viradeco'), $blogname) . "\r\n\r\n";
	        $message .= sprintf(__('Username: %s','viradeco'), $user_login) . "\r\n\r\n";
	        $message .= sprintf(__('E-mail: %s','viradeco'), $user_email) . "\r\n";
	        $message .= sprintf(__('Vira Club ID : V%s','viradeco'), $viraclub_id) . "\r\n";
	
	        wp_mail(get_option('admin_email'), sprintf(__('New User Registration','viradeco'), $blogname), $message);
	
	        if ( empty($plaintext_pass) )
	                return;
	
	        $message  = __('Your Information : ','viradeco')."\r\n";
	        $message  .= sprintf(__('Username: %s','viradeco'), $user_login) . "\r\n";
	        $message .= sprintf(__('Password: %s','viradeco'), $plaintext_pass) . "\r\n";
	        $message .= sprintf(__('Vira Club ID : V%s','viradeco'), $viraclub_id) . "\r\n";
	        $message .= get_the_permalink() . "\r\n";
	
	        wp_mail($user_email, sprintf(__('Welcome to Vira','viradeco'), $blogname), $message);
	
	}
?>