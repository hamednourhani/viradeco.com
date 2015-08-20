<?php
/*
*
*/?>
		<div class="post-meta">
				
						<ul class="post-meta-list">
							
							<li class="meta-date dt-published">
								<i class="fa fa-calendar"></i>
								<?php if(is_singular())	{
									 echo __('Published Date : ','viradeco');
								} ?>
								<?php if(function_exists('jdate')) {
									$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
													esc_url( get_permalink() ),
													esc_attr( get_the_time() ),
													esc_attr( jdate('c',strtotime($post->post_date)) ),
													esc_html( jdate(get_option('date_format'),strtotime($post->post_date)) )
													);
										} else {
									$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
													esc_url( get_permalink() ),
													esc_attr( get_the_time() ),
													esc_attr( get_the_date( 'c' ) ),
													esc_html( get_the_date() )
													);
										}
									echo $date; 
								?>


							</li>

						
							
							<?php if( 'news' == get_post_type() && is_singular()){
											$cat_list =get_the_term_list( get_the_ID(), 'news_cat', '<span class="cats-title">' . __( 'News category :', 'viradeco' ) . '</span> ', ', ' );
											$tag_list =get_the_term_list( get_the_ID(), 'news_tag', '<span class="tags-title">' . __( 'News Tags :', 'viradeco' ) . '</span> ', ', ' );
											?>
								
									<?php if ( $cat_list) { ?>
											
												<li class="meta-cat">
													<i class="fa fa-folder-open"></i>
													<?php echo $cat_list ;?>
												</li>
											
									<?php } ?>
								
									<?php if ( $tag_list) { ?>
											

												<li class="meta-tag">
													<i class="fa fa-tags"></i>
													<?php echo $tag_list ;?>
												</li>
									<?php } ?>
									
							<?php } ?>
							<?php if( 'notify' == get_post_type() && is_singular()){
											$cat_list =get_the_term_list( get_the_ID(), 'notify_cat', '<span class="cats-title">' . __( 'News category :', 'viradeco' ) . '</span> ', ', ' );
											
											?>
								
									<?php if ( $cat_list) { ?>
											
												<li class="meta-cat">
													<i class="fa fa-folder-open"></i>
													<?php echo $cat_list ;?>
												</li>
											
									<?php } ?>
								
																		
							<?php } ?>

							
							
							
						</ul><!--.post-meta-list-->
							
						
									
		</div><!--.post-meta-->		