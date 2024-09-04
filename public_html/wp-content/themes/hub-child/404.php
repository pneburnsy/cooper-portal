<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Hub theme
 */

get_header();

$data_content = liquid_helper()->get_option( 'error-404-content', 'post', '', 'options' );

$is_elementor = defined( 'ELEMENTOR_VERSION' );
$classnames = array(
'page-404',
'error-404',
'not-found',
'entry',
$is_elementor ? 'elementor' : ''
);

?>
    <article id="post-404" class="<?php esc_attr_e(implode(' ', $classnames)) ?>">

        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto text-center">

                    <div class="text-404">

                        <h1 class="liquid-counter-element text-primary">
                            <!--/.THIS IS NOT TRANSLATABLE OR DYNAMIC THING, IT NEEDS FOR THE EFFECTS -->
                            <span>404</span>
                        </h1>

                    </div>

                    <?php if( !class_exists( 'ReduxFramework' ) ) : ?>

                        <h3 class="font-weight-normal mb-3"><?php esc_html_e( 'Looks like you are lost.', 'hub' ); ?></h3>
                        <p class="mb-3"><?php esc_html_e( 'We can’t seem to find the page you’re looking for.', 'hub' ) ?></p>
                        <a href="<?php echo esc_url( home_url('/') ) ?>" class="btn elementor-button btn-solid btn-md pt-3 pb-3 px-5 ps-5 pe-5">
						<span class="p-0 d-flex align-items-center">
							<span class="btn-txt"><?php esc_html_e( 'Go Home!', 'hub' ); ?></span>
							<span class="btn-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" style="height: 1em;"><path d="M5.313 17.336h16.231l-7.481 7.481L16 26.687 26.688 16 16 5.312l-1.87 1.87 7.414 7.482H5.312v2.672z" fill="currentColor"></path></svg>
							</span>
						</span>
                        </a>

                    <?php else : ?>

                        <h3 class="font-weight-normal mb-3"><?php esc_html(liquid_helper()->get_option_echo( 'error-404-subtitle', 'html', '', 'options' )) ?></h3>
                        <?php if( !empty( $data_content ) ) : ?>
                            <p><?php echo wp_kses_post(  $data_content ); ?></p>
                        <?php endif ?>
                        <?php if( 'on' === liquid_helper()->get_option( 'error-404-enable-btn', 'raw', '', 'options' ) ) { ?>
                            <a href="/app/dashboard.php" class="btn elementor-button btn-solid btn-md pt-3 pb-3 px-5 ps-5 pe-5">
						<span class="p-0 d-flex align-items-center">
							<span class="btn-txt"><?php esc_html(liquid_helper()->get_option_echo( 'error-404-btn-title', 'html', '', 'options' )) ?></span>
							<span class="btn-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" style="height: 1em;"><path d="M5.313 17.336h16.231l-7.481 7.481L16 26.687 26.688 16 16 5.312l-1.87 1.87 7.414 7.482H5.312v2.672z" fill="currentColor"></path></svg>
							</span>
						</span>
                            </a>
                        <?php } ?>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </article>

<?php get_footer();