<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

// Get Uomo hompage sidebar
function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' => __( 'Hompage Uomo', 'wpb' ),
        'id' => 'home-uomo',
        'description' => __( 'Qui inserisci lo slider per la collezione uomo da visualizzare in homepage', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title uomo-home-slider">',
        'after_title' => '</h3>',
    ) );
 
    register_sidebar( array(
        'name' => __( 'Hompage Donna', 'wpb' ),
        'id' => 'home-donna',
        'description' => __( 'Qui inserisci lo slider per la collezione donna da visualizzare in homepage', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title donna-home-slider">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

// block gutemberg editor
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Function to remove sidebar on woocommerce single product
 * Author: Khokan Sardar https://stackoverflow.com/a/57654626/10259012
 */
function remove_sidebar_single_product_page() {
    if ( is_product() ) {
        // for understrap theme
        remove_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10 );
        // for default woocommerce structure
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
        // add wrapper end for single product
        add_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end_for_single_product', 11 );
    }
}
add_action( 'wp', 'remove_sidebar_single_product_page' );

function understrap_woocommerce_wrapper_end_for_single_product(){
    echo '</main><!-- #main -->';
    echo '</div><!-- .row -->';
    echo '</div><!-- Container end -->';
    echo '</div><!-- Wrapper end -->';
    echo '</div><!-- Wrapper end -->';
}
/**
 * Function to move buy button on woocommerce single product
 */
remove_action( 'woocommerce_single_product_summary', 
'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 
'woocommerce_template_single_add_to_cart', 15 );
/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' <span class=woocommerce_breadcrumb_div>&gt;</span> ';
	return $defaults;
}

// Define woocommerce gallery thumbnail size (aspect ratio remain 1:1)
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
    'width' => 350,
    'height' => 350,
    'crop' => 100,
    );
    } );

    

      //align wishlist button to add to cart
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_move_wishlist_button' ) ){
	function yith_wcwl_move_wishlist_button(  ){
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'yith_wcwl_move_wishlist_button' );
}

// Change WooCommerce "Related products" text

add_filter('gettext', 'change_rp_text', 10, 3);
add_filter('ngettext', 'change_rp_text', 10, 3);

function change_rp_text($translated, $text, $domain)
{
     if ($text === 'Related products' && $domain === 'woocommerce') {
         $translated = esc_html__('Selezionati per te', $domain);
     }
     return $translated;
}

// remove category on simple product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Add Inci Block on Simple Product page Woocommerce (ACF)
// add_action( 'woocommerce_after_single_product_summary', 'custom_single_product_banner', 12 );
// function custom_single_product_banner() {

//     $output = get_template_part( 'global-templates/inci-block' );

//     echo $output;
// }

// Add Saponi Block on Simple Product page Woocommerce (ACF)
add_action( 'woocommerce_after_single_product_summary', 'saponi_single_product_banner', 12 );
function saponi_single_product_banner() {

    $output = get_template_part( 'global-templates/box-saponi' );

    echo $output;
}

// Add Pre/After Block on Simple Product page Woocommerce (ACF)
add_action( 'woocommerce_after_single_product_summary', 'preafter_single_product_banner', 12 );
function preafter_single_product_banner() {

    $output = get_template_part( 'global-templates/box-afterpre' );

    echo $output;
}

// Add Cosmetica Block on Simple Product page Woocommerce (ACF)
add_action( 'woocommerce_after_single_product_summary', 'cosmetica_single_product_banner', 12 );
function cosmetica_single_product_banner() {

    $output = get_template_part( 'global-templates/box-cosmetica' );

    echo $output;
}

/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <a class="cart-contents head-ico" href="<?php echo $cart_url; ?>" title="My Basket">
	    <?php
        if ( $cart_count > 0 ) {
       ?>
            <span class="cart-contents-count head-ico"><?php echo $cart_count; ?></span>
        <?php
        }
        ?>
        </a>
        <?php
	        
    return ob_get_clean();}

    // Add to cart button counter

    add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
// Add to cart icon menu support
add_filter( 'wp_nav_menu_top-menu_items', 'woo_cart_but_icon', 10, 2 ); // Change menu to suit - example uses 'top-menu'
/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 */
function woo_cart_but_icon ( $items, $args ) {
       $items .=  '[woo_cart_but]'; // Adding the created Icon via the shortcode already created
       
       return $items;
}

// Shortcode creation for disply a bio icons box 
function bio_icon_box_html_render( $atts, $content, $tag ) {  

    ob_start();
    get_template_part( 'global-templates/soap-icon-box' );
    return ob_get_clean();}
add_shortcode("bio_icon_box", "bio_icon_box_html_render"); 

// Add to cart 
add_shortcode ('woo_cart_but', 'woo_cart_but' );

// Remove Sidebar from woo pages
add_filter( 'genesis_site_layout', 'woocommerce_page_layout' );
function woocommerce_page_layout() {
    if ( is_page ( array( 'cart', 'checkout' )) || is_shop() || 'product' == get_post_type() || is_woocommerce() ) {
        return 'full-width-content';
    }
}
function your_theme_customizer_setting($wp_customize) {
    // add a setting 
        $wp_customize->add_setting('your_theme_mobile_logo');
    // Add a control to upload the hover logo
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'your_theme_mobile_logo', array(
            'label' => 'Mobile Logo',
            'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
            'settings' => 'your_theme_mobile_logo',
            'priority' => 8 // show it just below the custom-logo
        )));
    }
    
    add_action('customize_register', 'your_theme_customizer_setting');

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = __( 'Esperienza' );		// Rename the description tab


	return $tabs;

}
add_filter( 'woocommerce_product_description_heading', 'rename_product_description_heading', 10, 1 );
function rename_product_description_heading( $heading ) {
    return  __( 'Esperienza', 'woocommerce' );
}

// Replace add to cart button by a linked button to the product in Shop and archives pages
add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 10, 2 );
function replace_loop_add_to_cart_button( $button, $product  ) {
    // Not needed for variable products
    if( $product->is_type( 'variable' ) ) return $button;

    // Button text here
    $button_text = __( "Shop Now", "woocommerce" );

    return '<a class="add_to_cart_button product_type_simple single_add_to_cart_button btn btn-outline-primary btn-block ajax_add_to_cart" href="' . $product->get_permalink() . '">' . $button_text . '</a>';
}

// disable all notification core, plugins ecc
function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

// override country-select.js [checkout button]

add_action('wp_enqueue_scripts', 'override_wc_country_select');
function override_wc_country_select() {
	wp_deregister_script('wc-country-select');
	wp_enqueue_script('wc-country-select', get_template_directory_uri() . '/woocommerce/js/country-select.js', array('jquery'), null, true);
}

