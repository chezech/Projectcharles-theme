<?php
/**
 * Projectcharles theme
 * Project Charles: This file extends the options.php page specifically for dispalying custom category post on  the static frontpage
 * @package Project_Charles
 * This is CCT460H Summer 2016 Course Assginment at University of Toronto
 * The aim of the assignment is to develop a responsive WordPress theme with required functionalities
 *This theme's file, like WordPress, is licensed under the GPL.
 Use it to make something cool, have fun, and share what you've learned with others.
 *Project Charles is distributed under the terms of the GNU GPL v2 or later.
 *


/***************************This page extends the options.php page specifically for dispalying custom category post on the static frontpage
---------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------------
Featured post from a specific category
----------------------------------------------------*/

?><div class="static_front"> <?php
$category_name= get_option('projectcharles_feat_cat');// the get_option fetches the variables set in the options.php 
$number_of_post= get_option('projectcharles_num_post');

// Checks the category name and the number of posts per page
query_posts("category_name=$category_name.&showposts=$number_of_post");
while (have_posts()) : the_post();
				get_template_part( 'template-parts/content', get_post_format() );
endwhile;
?></div> <?php
/*---------------------------------------------------
Show portolio of works on static front page
----------------------------------------------------*/
$show_porfolio= get_option('projectcharles_portfolio'); // store variable from the checkbox set in the options.php

//Check if a user wants to display the portfolio of works from a specific category on a the static front page
if (!empty($show_porfolio)){
query_posts('post_type=portfolio&posts_per_page=4');

?>
		<div class="static_front">
		<div id="portfolio_title"><h1>Portfolio of Work</h1></div>
<div class="wrapper">
	<div class="center"> 
		</div>
			<div class="circle">
			        <ul>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 	<li> 
    <?php
        $title= str_ireplace('"', '', trim(get_the_title()));
        $desc= str_ireplace('"', '', trim(get_the_content()));
    ?>   
   <a href="<?php print  projectcharles_thumbnail_url($post->ID) ?>"><?php the_post_thumbnail(); ?></a>
                <h4><strong><?=$title?></strong>
                <?php $site= get_post_custom_values('projLink'); 
                    if($site[0] != ""){
                ?>
                    <a href="<?=$site[0]?>">More</a>
                </h4>   
                <?php }?>
         </li>
<?php endwhile; endif; ?>
        </ul>
		      </div>
      </div>
	  </div>
 
<?php } ?> <!------------ End of if ($how_porfolio)-------------->	  
<?php get_footer(); ?>