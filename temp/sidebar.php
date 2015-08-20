<?php if ( is_active_sidebar( 'sidebar' )) : ?>
		
		<div class="secondary" id="secondary">
				
				<div id="sidebar-widget" class="sidebar-widget">
					<?php dynamic_sidebar( 'sidebar' ); ?>  
				</div><!--.sticky-widget-->  
				
				
		</div><!--.secondary-->

 <?php endif; ?>