<div id="sidr-right" class="sidr right">
<?php global $blog_id; ?>
	<?php if (get_option('blog_public') == '1' || (get_option('blog_public') == '0' && current_user_can_for_blog($blog_id, 'read'))): ?>

	<div class="slide-toc">
		
					
		<ul class="book-nav">
		<!-- If Logged in show ADMIN -->
			<?php global $blog_id; ?>
			<?php if (current_user_can_for_blog($blog_id, 'edit_posts') || is_super_admin()): ?>
				<li class="icon-fontawesome-webfont-2"><a href="<?php echo get_option('home'); ?>/wp-admin"><?php _e('Admin', 'pressbooks'); ?></a></li>
			<?php endif; ?>
		
				<li class="icon-home-1"><a href="<?php echo get_option('home'); ?>"><?php _e('Home', 'pressbooks'); ?></a></li>

		<!-- TOC button always there -->
				<li class="toc-btn"><a href="<?php echo get_option('home'); ?>/table-of-contents"><?php _e('Table of Contents', 'pressbooks'); ?></a></li>
			</ul>

		<!-- Pop out TOC only on READ pages -->
		<?php if (is_single()): ?>
		<?php $book = pb_get_book_structure(); ?>
		<div class="toc">
			<ul>
				<li>
					<ul>
						<?php foreach ($book['front-matter'] as $fm): ?>
						<?php if ($fm['post_status'] != 'publish') continue; // Skip ?>
						<li><a href="<?php echo get_permalink($fm['ID']); ?>"><?php echo $fm['post_title'];?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php foreach ($book['part'] as $part):?>
				<li><h4><?php if ( count( $book['part'] ) > 1 ) echo $part['post_title']; ?></h4></li>
				<li>
					<ul>
						<?php foreach ($part['chapters'] as $chapter) : ?>
							<?php if ($chapter['post_status'] != 'publish') continue; // Skip ?>
							<li><a href="<?php echo get_permalink($chapter['ID']); ?>"><?php echo $chapter['post_title']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php endforeach; ?>
				<li>
					<ul>
						<?php foreach ($book['back-matter'] as $fm): ?>
						<?php if ($fm['post_status'] != 'publish') continue; // Skip ?>
						<li><a href="<?php echo get_permalink($fm['ID']); ?>"><?php echo $fm['post_title'];?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</div><!-- end #toc -->
		<?php endif; ?>


	</div><!-- end #sidebar -->
	<?php endif; ?>
</div>