<?php
/* Template Name: Portfolio */
/**
 * Projectcharles theme
 * Project Charles: This file extends the options.php page specifically for dispalying custom category post on  the static frontpage
 * @package Project_Charles
 * This is CCT460H Summer 2016 Course Assginment at University of Toronto
 * The aim of the assignment is to develop a responsive WordPress theme with required functionalities
 *This theme's file, like WordPress, is licensed under the GPL.
 Use it to make something cool, have fun, and share what you've learned with others.
 *Project Charles is distributed under the terms of the GNU GPL v2 or later.
 */ 
 
get_header(); 

//load the portfolio styles
function fetch_portfolio_script() {	
wp_enqueue_style( 'portfolio-style', get_template_directory_uri() . '/inc/portfolio/css/portfolio.css' );
}	
add_action( 'wp_enqueue_scripts', 'fetch_portfolio_script' );

query_posts('post_type=portfolio&posts_per_page=9');?>

<div id="portfolio" class="group"> 
 
<h2>Portfolio of Work</h2>
 
<div class="group">
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
    <?php
        $title= str_ireplace('"', '', trim(get_the_title()));
        $desc= str_ireplace('"', '', trim(get_the_content()));
    ?>   
 
    <div class="item">
                <div class="img"><a href="<?php print  projectcharles_thumbnail_url($post->ID) ?>"  title="<?=$title?>: <?=$desc?>" rel="lightbox[work]"><?php the_post_thumbnail(); ?></a></div>
                <p><strong><?=$title?>:</strong> <?php print get_the_excerpt(); ?> <a href="<?php print  projectcharles_thumbnail_url($post->ID) ?>" title="<?=$title?>: <?=$desc?>" rel="lightbox[work]">(more)</a></p>
                <?php $site= get_post_custom_values('projLink'); 
                    if($site[0] != ""){
                 
                ?>
                    <p><a href="<?=$site[0]?>">Read more</a></p>
                     
                <?php }else{ ?>
                    <p><em>Live Link Unavailable</em></p>
                <?php } ?>
            </div>
 
         
<?php endwhile; endif; ?>
 
</div>
 
</div>
<?php get_footer(); ?>