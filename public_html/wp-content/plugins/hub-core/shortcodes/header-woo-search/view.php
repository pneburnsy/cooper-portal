<?php

// check
if ( ! liquid_helper()->is_woocommerce_active() ) {
	return;
}

$search_id = uniqid( 'search-' );

$classes = [ 'liquid-wc-product-search' ];

$category_dropdown = $atts[ 'enable_category_dropdown' ] === 'on';
$ajax_search       = $atts[ 'enable_ajax' ] === 'on';

$input_id = uniqid( 'liquid-wc-product-search-field-input-' );

if ( $category_dropdown ) {
	$select_id    = uniqid( 'liquid-wc-product-search-field-select-' );
	$product_cats = get_terms( [ 'taxonomy' => 'product_cat' ] );
	$classes[]    = 'liquid-wc-product-search-category-enabled';
}

if ( $ajax_search ) {
	$classes[] = 'liquid-wc-product-search-ajax-enabled';
}

$this->generate_css();

?>
<div class="header-module module-product-search <?php echo $atts['show_on_mobile'] ?>">
    <span class="ld-module-trigger" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . $search_id; ?>" aria-controls="<?php echo $search_id ?>" aria-expanded="false">
        <span class="ld-module-trigger-icon">
            <i class="lqd-icn-ess icon-ld-search"></i>
        </span>
    </span>
    <div class="ld-module-dropdown collapse" id="<?php echo $search_id ?>" aria-expanded="false">
        <form role="search" method="get" class="<?php echo implode( ' ', $classes ); ?>"
            action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label class="screen-reader-text"
                for="<?php echo $input_id; ?>"><?php esc_html_e( 'Search for:', 'landinghub-core' ); ?></label>
            <input type="search" id="<?php echo $input_id; ?>" class="search-field"
                placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'landinghub-core' ); ?>"
                value="<?php echo get_search_query(); ?>" name="s"/>
            <label class="screen-reader-text"
                for="<?php echo $select_id; ?>"><?php esc_html_e( 'Product Category:', 'landinghub-core' ); ?></label>
            <?php if ( $category_dropdown ) { ?>
                <div class="search-field-select">
                    <select id="<?php echo $select_id; ?>" class="search-field" name="product_cat">
                        <option value="" data-term-id=""><?php esc_html_e( 'All Categories', 'landinghub-core' ); ?></option>
                        <?php foreach ( $product_cats as $product_cat ) { ?>
                            <option value="<?php echo $product_cat->slug; ?>" data-term-id="<?php echo $product_cat->term_id; ?>"><?php echo $product_cat->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            <?php } ?>
            <button type="submit">
                <span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'landinghub-core' ); ?></span>
                <i class="lqd-icn-ess icon-ld-search"></i>
                <span class="loading-icon">
                    <i class="lqd-icn-ess icon-lqd-sync"></i>
                </span>
            </button>
            <input type="hidden" name="post_type" value="product"/>
        </form>
    </div>
</div>