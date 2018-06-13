<?php

//Enqueues
function my_enqueue_style(){
    wp_enqueue_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style('main_style',get_template_directory_uri().'/style.css');

    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
    wp_enqueue_script('main_js',get_template_directory_uri().'/assets/js/main.js' );

    wp_enqueue_script( 'true_loadmore', get_stylesheet_directory_uri() . '/assets/js/loadmore.js', array('jquery') );


}

// Actions and filters

add_action('wp_enqueue_scripts','my_enqueue_style');


register_nav_menu( 'header_menu', 'Header menu' );

add_theme_support( 'post-thumbnails' );

function new_excerpt_length($length) {
    return 3;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_filter('excerpt_more', function($more) {
    return '...';
});

function trim_title_words($count, $after) {
    $title = get_the_title();
    $words = split(' ', $title);
    if (count($words) > $count) {
        array_splice($words, $count);
        $title = implode(' ', $words);
    }
    else $after = '';
    echo $title . $after;
}

function true_register_wp_sidebars() {


    register_sidebar(
        array(
            'id' => 'sidebar_info', // уникальный id
            'name' => 'sidebar_info', // название сайдбара
            'description' => 'Drag widgets here to add in sidebar.', // описание
            'before_widget' => '<div id="%1$s" class="side widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">', // по умолчанию заголовки виджетов в <h2>
            'after_title' => '</h3>'
        )
    );

    register_sidebar(
        array(
            'id' => 'sidebar_footer',
            'name' => 'sidebar_footer',
            'description' => 'Drag widgets here to add in sidebar.',
            'before_widget' => '<div id="%1$s" class="foot widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        )
    );
}

add_action( 'widgets_init', 'true_register_wp_sidebars' );


//----------------------------------------------

function load_more_posts(){

    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';

    query_posts( $args );

    if( have_posts() ) {
        while (have_posts()): the_post();

            get_template_part('template-parts/posts/posts', 'show');
        endwhile;
    }
    wp_die();
}


add_action('wp_ajax_loadmore', 'load_more_posts');
add_action('wp_ajax_nopriv_loadmore', 'load_more_posts');


function load_prev_posts(){
    $args = unserialize( stripslashes( $_POST['query'] ) );
    $args['paged'] = $_POST['page'] - 1; // предыдущая страница
    $args['post_status'] = 'publish';

    query_posts( $args );

    if( have_posts() ) {
        while (have_posts()): the_post();

            get_template_part('template-parts/posts/posts', 'show');
        endwhile;
    }
    wp_die();
}

add_action('wp_ajax_loadprev', 'load_prev_posts');
add_action('wp_ajax_nopriv_loadprev', 'load_prev_posts');



add_action('admin_menu', function(){
    add_menu_page( 'Custom site settings', 'Custom settings', 'manage_options', 'site-options', 'add_my_setting', '', 4 );
} );

function add_my_setting(){
    ?>
    <div class="wrap">
        <h2><?php echo get_admin_page_title() ?></h2>

        <?php
        // settings_errors() не срабатывает автоматом на страницах отличных от опций
        if( get_current_screen()->parent_base !== 'options-general' )
            settings_errors('название_опции');
        ?>

        <form action= '<?php echo get_template_directory_uri().'/options.php'?>' method="POST" enctype="multipart/form-data">
            <label for="tel">Input new telephone: </label>
            <input type="tel" class="tel" id="tel" name="tel" pattern="\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="(050)121-34-57" title="Формат ввода (050)121-34-57" >
            <br><br>
            <label for="logo">Choose new logotype: </label>
            <input type="file" id="logo" name="logo" multiple="false">

            <?php
            wp_nonce_field( 'logo', 'logo_nonce' );
            settings_fields("opt_group");     // скрытые защитные поля
            do_settings_sections("opt_page"); // секции с настройками (опциями).
            submit_button();
            ?>

        </form>

    </div>

<?php
}

function my_enqueue_media() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'my_enqueue_media' );



//************************************************************************************//

//function get_images_from_media_library() {
//    $args = array(
//        'post_type' => 'attachment',
//        'post_mime_type' =>'image',
//        'post_status' => 'inherit',
//        'posts_per_page' => 20,
////        'orderby' => 'rand'
//    );
//    $query_images = new WP_Query( $args );
//    $images = array();
//    foreach ( $query_images->posts as $image) {
//        $images[]= $image->guid;
//    }
//    return $images;
//}
//
//function display_images_from_media_library() {
//
//    $imgs = get_images_from_media_library();
//    $html = '<div id="media-gallery">';
//
//    foreach($imgs as $img) {
//
//        $html .= '<img src="' . $img . '" alt="" />';
//
//    }
//
//    $html .= '</div>';
//
//    return $html;
//
//}

// WIDGET WIDGET WIDGET

class My_First_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_WP_book', // widget ID
            'My own widget ', // widget NAME
            array( 'description' => __( 'My first widget'), ) // widget DESCRIPTION
        );
    }
    public function form( $instance ) {
        ?>
        <div>
            <label for="<?php echo $this->get_field_id( 'first_title' ); ?>">Title</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'first_title' ); ?>"
                   name="<?php echo $this->get_field_name( 'first_title' ); ?>" type="text"
                   value="<?php echo $instance[ 'first_title' ]; ?>"
            />
        </div>
        <div>
            <label for="<?php echo $this->get_field_id( 'first_information' ); ?>">Information</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'first_information' )?>"
                      name="<?php echo $this->get_field_name( 'first_information' ); ?>">
                  <?php echo $instance[ 'first_information' ]; ?>
            </textarea>
        </div>
        <br>
        <div>
            <label for="<?php echo $this->get_field_id( 'second_title' ); ?>">Title</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'second_title' ); ?>"
                   name="<?php echo $this->get_field_name( 'second_title' ); ?>" type="text"
                   value="<?php echo $instance[ 'second_title' ]; ?>"
            />
        </div>
        <div>
            <label for="<?php echo $this->get_field_id( 'second_information' ); ?>">Information</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'second_information' )?>"
                      name="<?php echo $this->get_field_name( 'second_information' ); ?>">
                 <?php echo $instance[ 'second_information' ]; ?>
            </textarea>
        </div>
        <br>
        <div>
            <label for="<?php echo $this->get_field_id( 'third_title' ); ?>">Title</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'third_title' ); ?>"
                   name="<?php echo $this->get_field_name( 'third_title' ); ?>" type="text"
                   value="<?php echo $instance[ 'third_title' ]; ?>"
            />
        </div>
        <div>
            <label for="<?php echo $this->get_field_id( 'third_information' ); ?>">Information</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'third_information' )?>"
                      name="<?php echo $this->get_field_name( 'third_information' ); ?>">
                 <?php echo $instance[ 'third_information' ]; ?>
            </textarea>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        if(!empty($new_instance['first_title']) && !empty($new_instance['first_information'])){
            $instance['first_title'] = strip_tags( $new_instance['first_title']);
            $instance['first_information'] = strip_tags( $new_instance['first_information']);
        }

        if(!empty($new_instance['second_title']) && !empty($new_instance['second_information'])){
            $instance['second_title'] = strip_tags( $new_instance['second_title']);
            $instance['second_information'] = strip_tags( $new_instance['second_information']);
        }

        if(!empty($new_instance['third_title']) && !empty($new_instance['third_information'])){
            $instance['third_title'] = strip_tags( $new_instance['third_title']);
            $instance['third_information'] = strip_tags( $new_instance['third_information']);
        }

        return $instance;
    }

    public function widget( $args, $instance ) {
        ?>
        <div class="sbr-container">
            <div class="sbr row">
        <?php
        if(count($this->update($instance, 0)) == 6){
            ?>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-home"> <?php echo $instance[ 'first_title' ]; ?></span>
                <p><?php echo $instance[ 'first_information' ]; ?></p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-home"> <?php echo $instance[ 'second_title' ]; ?></span>
                <p><?php echo $instance[ 'second_information' ]; ?></p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-home"> <?php echo $instance[ 'third_title' ]; ?></span>
                <p><?php echo $instance[ 'third_information' ]; ?></p>
            </div>
            <?php
        }
        elseif (count($this->update($instance, 0)) == 4) {
            if (array_key_exists('first_title', $this->update($instance, 0))) {
                ?>
                <div class="col-sm-6">
                    <span class="glyphicon glyphicon-home"> <?php echo $instance['first_title']; ?></span>
                    <p><?php echo $instance['first_information']; ?></p>
                </div>
                <?php
            }
            if (array_key_exists('second_title', $this->update($instance, 0))) {
                ?>
                <div class="col-sm-6">
                    <span class="glyphicon glyphicon-home"> <?php echo $instance['second_title']; ?></span>
                    <p><?php echo $instance['second_information']; ?></p>
                </div>
                <?php
            }
            if (array_key_exists('third_title', $this->update($instance, 0))) {
                ?>
                <div class="col-sm-6">
                    <span class="glyphicon glyphicon-home"> <?php echo $instance['third_title']; ?></span>
                    <p><?php echo $instance['third_information']; ?></p>
                </div>
                <?php
            }
        }
                ?>
            </div>
        </div>
    <?php
    }
}

add_action( 'widgets_init', function(){
    register_widget( 'My_First_Widget' );
});


?>
