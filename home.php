<!--
/**
 * Projectcharles theme
 * Projectcharles custom home page template
 * @package Project_Charles
 * This is CCT460H Summer 2016 Course Assginment at University of Toronto
 * The aim of the assignment is to develop a responsive WordPress theme with required functionalities
 *This theme's options file, like WordPress, is licensed under the GPL.
 Use it to make something cool, have fun, and share what you've learned with others.
 *Project Charles is distributed under the terms of the GNU GPL v2 or later.
 *
!-->
<?php /* Template Name: Home */?> 
<?php get_header(); ?>

<div class="sliderwidget">
        <div class="sliderwidget_image">
            <section>
			<?php 
		if(function_exists('projectcharles_slider_template')){
			echo projectcharles_slider_template();
		}
			?>
			</section>
		</div>
</div>
<?
get_footer();