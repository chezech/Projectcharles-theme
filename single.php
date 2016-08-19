<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Project_Charles
 */

get_header(); ?>
<div class="main">
    <div class="container clearfix">
        <div class="content">
            <section>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		      </section>
        </div><!------.content----------->
		        <div class="sidebar">
            <aside>
			<?php get_sidebar(); ?>
            </aside>
        </div>
    </div><!------.container----------->
	</div><!-- .main-->

<?php
get_footer();
