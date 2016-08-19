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
 */

/***********Add support for the featured images part of the portfolio **************/
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 280, 210, true ); // Normal post thumbnails
    add_image_size( 'screen-shot', 720, 540 ); // Full size screen
}
add_action('init', 'projectcharles_portfolio_register');  

/***********Create the portfolio Post type**************/     
function projectcharles_portfolio_register() { //sets up an array of arguments for sending the portfolio post type. 
    $args = array(  
        'label' => __('Portfolio'),  
        'singular_label' => __('Project'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
   
    register_post_type( 'portfolio' , $args );  
}
/***********create custom taxonomy for the portfolio Post type**************/ 
register_taxonomy("project-type", array("portfolio"), array("hierarchical" => true, "label" => "Project Types", "singular_label" => "Project Type", "rewrite" => true));
add_action("admin_init", "projectcharles_meta_box");   
 
/***********This creates the custom field box**************/ 
function projectcharles_meta_box(){  
    add_meta_box("projInfo-meta", "Project Options", "projectcharles_meta_options", "portfolio", "side", "low");  
}  
/***********This function creates a form field that will be used to fetch the project's link.**************/ 
function projectcharles_meta_options(){  
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);  
        $link = $custom["projLink"][0];  
?>  
    <label>Link:</label><input name="projLink" value="<?php echo $link; ?>" />  
<?php  
    }

/***********This function saves the custom project link**************/		
add_action('save_post', 'save_portfolio_link');    
function save_portfolio_link(){  
    global $post;  
     
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
        return $post_id;
    }else{
        update_post_meta($post->ID, "projLink", $_POST["projLink"]); 
    } 
}

/***********Customize the list showing all the projects**************/
add_filter("manage_edit-portfolio_columns", "project_edit_fields");     
function project_edit_fields($fields){  
        $fields = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Project",  
            "description" => "Description",  
            "link" => "Link",  
            "type" => "Type of Project",			
        );  
   
        return $fields;  
}  

/***********Customize the list showing all the projects**************/
add_action("manage_posts_custom_column",  "projectcharles_custom_fields");    
function projectcharles_custom_fields($field){  
        global $post;  
        switch ($field)  
        {  
            case "description":  
                the_excerpt();  
                break;  
            case "link":  
                $custom = get_post_custom();  
                echo $custom["projLink"][0];  
                break;  
            case "type":  
                echo get_the_term_list($post->ID, 'project-type', '', ', ','');  
                break;  
        }  
}

/***********Fetch the excerpt's length**************/
add_filter('excerpt_length', 'my_excerpt_length'); 
function my_excerpt_length($length) {
 
    return 25; 
 
}
 
add_filter('excerpt_more', 'new_excerpt_more');  
 
function new_excerpt_more($text){  
 
    return ' ';  
 
}  
 /***********Fetch the thumbnail link**************/
function projectcharles_thumbnail_url($pid){
    $image_id = get_post_thumbnail_id($pid);  
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
    return  $image_url[0];  
}



?>