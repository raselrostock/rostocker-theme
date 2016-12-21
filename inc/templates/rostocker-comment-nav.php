<nav class="comment-navigation" role="navigation">
			<h3><?php esc_html_e('Comment navigation', 'rostockertheme');?></h3>
			<div class="row">
					<div class="col-xs-12 col-sm-6">
							<div class="post-link-nav">
								<span class="rostocker-icon rostocker-chevron-left" aria-hidden="true"></span>
								<?php
								 previous_comments_link(esc_html__('Older Comments','rostockertheme' ));
								?>
							</div>
					</div>	<!-- .col-xs-12 -->
					<div class="col-xs-12 col-sm-6">
							<div class="post-link-nav">
								<?php
								 next_comments_link(esc_html__('Newer Comments','rostockertheme' ));
								?>
								<span class="rostocker-icon rostocker-chevron-right" aria-hidden="true"></span>
								
							</div>
					</div>	<!-- .col-xs-12 -->
				</div>	<!-- .row -->

			
		</nav>