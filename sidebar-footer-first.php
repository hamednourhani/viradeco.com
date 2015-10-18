<?php if ( is_active_sidebar( 'footer-first' )) : ?>
		
		<div class="products-area">
			<section class="layout">
				 
					<div class="products-widget-col">
						<?php dynamic_sidebar( 'footer-first' ); ?>
					</div>
					
					<div class="products-widget-col">
						<?php dynamic_sidebar( 'footer-first-col2' ); ?>
					</div>
					
					<div class="products-widget-col">
						<?php dynamic_sidebar( 'footer-first-col3' ); ?>
					</div>
					
					<div class="products-widget-col">
						<?php dynamic_sidebar( 'footer-first-col4' ); ?>
					</div>
				

				
<!-- 
				<aside class="widget oneFourth product-widget">
					<header class="widgettitle">
						<h4>کانتر</h4>
					</header>
					<main class="widgetbody">
						<ul class="products-list">
							<li><img src="images/thumb/counter/thumb1.png" alt=""><span>Air</span></li>
							<li><img src="images/thumb/counter/thumb2.png" alt=""><span>Curva</span></li>
							<li><img src="images/thumb/counter/thumb3.png" alt=""><span>Estel</span></li>
							<li><img src="images/thumb/counter/thumb5.png" alt=""><span>Kube</span></li>
						</ul>
						
					</main>
				</aside>
 -->

			</section>
		</div>		

		  
				
 <?php endif; ?>