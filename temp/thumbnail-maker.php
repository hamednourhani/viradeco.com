<?php if ( has_post_thumbnail() ) {
	echo the_post_thumbnail('medium');

} else { 
 echo '<img src="'.get_template_directory_uri().'/images/default-thumbnail.jpg" alt="'.get_the_title().'" />';

} ?>
