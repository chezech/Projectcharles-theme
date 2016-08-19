<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		      </section>
        </div><!------.content----------->
		<!-----------------display sidebar by the side of the main content------------->
		        <div class="sidebar">
            <aside>
			<?php get_sidebar(); ?>
            </aside>
        </div>
    </div><!------.container----------->
	</div><!-- .main-->

<?php
get_sidebar();
get_footer();
