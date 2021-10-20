<?php 

add_action( "init", "myplugin_news_post" );

/**
 * myplugin_news_post
 *
 * @return void
 */
function myplugin_news_post() {
    register_post_type( "news", array(
        "label" => "Custom news post",
        "labels" => array(
            "add_new" => "New Global news" 
        ),
        "public" => true,
        "description" => "Test custom post type for news",
        "supports" => ["thumbnail", "title", "comments", "custom-fields", "editor"]
    ) );
}

add_filter( "template_include", "myplugin_news_template" );
/**
 * myplugin_news_template
 *
 * @param  mixed $template
 * @return $template
 */
function myplugin_news_template($template) {
    global $post;
    if( is_single() AND $post->post_type == "news"){
        $template = PLUGIN_PATH. "template/myplugin-news.php";
    }
    return $template;
}