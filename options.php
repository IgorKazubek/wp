<?php
//
require_once '../../../wp-load.php';
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );

$attachment_id = media_handle_upload( 'logo', 0 );

if (is_array($attachment_id)){
    var_dump($attachment_id) ;
    if ( is_wp_error( $attachment_id ) )
        echo "Error to load image";
}
else{
    $upload_dir = wp_get_upload_dir();
    if(!empty($_FILES['logo']['name'])){
        $wpdb->update( 'wp_options',
            array( 'option_value' => $upload_dir['url'] . '/' .$_FILES['logo']['name']),
            array( 'option_id' => 595 )
        );
    }
}

$number = $wpdb->get_var($wpdb->prepare('SELECT option_value FROM wp_options WHERE option_id=%d', 597));

if(!empty($_POST['tel']) && $_POST['tel']!= $number){
    $wpdb->update( 'wp_options',
        array( 'option_value' => '+38'.$_POST['tel']),
        array( 'option_id' => 597 )
        );
}
echo wp_redirect(ABSPATH . 'wp-admin/admin.php?page=site-options');

?>


