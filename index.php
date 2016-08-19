<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Project_Charles
 */

get_header();?>

<div class="sliderwidget">
        <div class="sliderwidget_image">
            <section>
			<?php echo wptuts_slider_template(); ?>
			</section>
		</div>
</div>
			
	<div class="main">
    <div class="container clearfix">
        <div class="content">
            <section>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
		      </section>
        </div><!------.content----------->
		        <div class="sidebar">
			            <aside>
				<?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
		            <aside>
				<?php dynamic_sidebar('sidebar-2'); ?>
            </aside>
        </div>
    </div><!------.container----------->
	</div><!-- .main-->
</div>	
<?php
get_footer();

