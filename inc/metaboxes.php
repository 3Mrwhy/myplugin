<?php
add_action( 'admin_init', 'myplugin_meta_box' );

function myplugin_meta_box() {
    // add_meta_box( $id:string, $title:string, $callback:callable, $screen:string|array|WP_Screen|null, $context:string, $priority:string, $callback_args:array|null )

    add_meta_box( "_mycustommetaox", "my custom meta box", "myplugin_metabox", ["post", "page"] );
}

function myplugin_metabox($post) {
    $_mymetabox = get_post_meta( $post->ID, "_mymetabox", true ) ? get_post_meta( $post->ID, "_mymetabox", true ): "" ;
    $_myselectbox = get_post_meta( $post->ID, "_myselectbox", true )? get_post_meta( $post->ID, "_myselectbox", true ): "";
  ?>
    <input type="text" id="" name="_mymetabox" class="" value="<?php echo $_mymetabox ?>" />
    <select name="_selectbox"> 
      <option value="1" <?php echo $_myselectbox == 1? "selected": "" ?>> One </option>
      <option value="2" <?php echo $_myselectbox == 2? "selected": "" ?>> Two </option>
      <option value="3" <?php echo $_myselectbox == 3? "selected": "" ?>> Three </option>
    </select>
  <?php   
}

add_action( "save_post", "myplugin_save_post" );
function myplugin_save_post($post_id) {
    if( array_key_exists( "_mymetabox", $_POST ) && array_key_exists( "_selectbox", $_POST ) )   {
      // update_post_meta( post_id, meta_key, meta_value, prev_value ) 
      update_post_meta( $post_id, "_mymetabox", $_POST["_mymetabox"] );
      update_post_meta( $post_id, "_myselectbox", $_POST["_selectbox"] );
    } 
}  