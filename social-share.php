<?php
//To Create the admin menu item
function social_media_button() 
{
	wp_enqueue_style( 'social_media_style', get_template_directory_uri() . '/inc/socialshare/css/style.css' );
}
add_action("wp_enqueue_scripts", "social_media_button");


function social_media_item()
{
  add_submenu_page("options-general.php", "social Media", "social Media", "manage_options", "social-media", "social_media_page"); 
}
add_action("admin_menu", "social_media_item");

//Show the content of the social media options page
function social_media_page()
{
   ?>
      <div class="container">
         <h1>Social Media Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_media_config");
 
               do_settings_sections("social-media");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}
// To show each social media and its option fields.
function set_social_media()
{
    add_settings_section("social_media_config", "", null, "social-media");
    add_settings_field("social-media-facebook", "Show Facebook share button?", "facebook_checkbox", "social-media", "social_media_config");
    add_settings_field("twitter", "Show Twitter share button?", "twitter_checkbox", "social-media", "social_media_config");
    add_settings_field("linkedin", "Show LinkedIn share button?", "linkedin_checkbox", "social-media", "social_media_config");
 
    register_setting("social_media_config", "social-media-facebook");
    register_setting("social_media_config", "twitter");
    register_setting("social_media_config", "linkedin");
}

//Show Facebook option fields. 
function facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="social-media-facebook" value="1" <?php checked(1, get_option('social-media-facebook'), true); ?> /> 
   <?php
}

//Show Titter option fields. 
function twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="twitter" value="1" <?php checked(1, get_option('twitter'), true); ?> />
   <?php
}

//Show linkedin option fields. 
function linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="linkedin" value="1" <?php checked(1, get_option('linkedin'), true); ?> /> 
   <?php
}
// To display the social media icons on the post page
add_action("admin_init", "set_social_media");
function add_social_share_icons($content)
{
if((get_option("social-media-facebook") == 1)||(get_option("twitter") == 1)||(get_option("linkedin") == 1)){   
 $html = "<div class='social_container'><div class='share-on'>Share on: </div>";
}

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    if(get_option("social-media-facebook") == 1)
    {
        $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>Facebook</a></div>";
    }

    if(get_option("twitter") == 1)
    {
        $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'>Twitter</a></div>";
    }

    if(get_option("linkedin") == 1)
    {
        $html = $html . "<div class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>LinkedIn</a></div>";
    }

    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;
}

add_filter("the_content", "add_social_share_icons");
?>