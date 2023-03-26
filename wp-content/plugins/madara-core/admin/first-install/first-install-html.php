<?php

    delete_transient( 'wp_manga_welcome_redirect', false );
    
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php esc_html_e( 'WP Manga &rsaquo; Welcome', WP_MANGA_TEXTDOMAIN ); ?></title>
    <?php wp_print_scripts( 'manga_bootstrap_js' ); wp_print_scripts( 'manga_first_install_js' );  ?>
    <?php do_action( 'admin_print_styles' ); ?>
    <?php do_action( 'admin_head' ); ?>
</head>

<body class="wp-manga-first-install-page">
    <section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <div class="liner">
                                <div class="liner active-liner"></div>
                            </div>
                            <li>
                                <a href="#step-1" data-toggle="tab" data-step="1" title="Step 1">
                                    <span class="round-tabs one">
                                        <span class="step-no">1</span>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                                </a></li>

                                <li><a href="#step-2" data-toggle="tab" data-step="2" title="Step 2">
                                    <span class="round-tabs two">
                                        <span class="step-no">2</span>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </li>
                            <li><a href="#step-3" data-toggle="tab" data-step="3" title="Step 3">
                                <span class="round-tabs three">
                                    <span class="step-no">3</span>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span> </a>
                            </li>

                            <li><a href="#step-4" data-toggle="tab" data-step="4" title="Step 4">
                                <span class="round-tabs four">
                                    <span class="step-no">4</span>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                            </a></li>

                            <li><a href="#step-5" data-toggle="tab" data-step="5" title="Step 5">
                                <span class="round-tabs five">
                                    <span class="step-no">5</span>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </span> </a>
                            </li>

                        </ul></div>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="wp-manga-welcome">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-0.php'; ?>
                            </div>

                            <div class="tab-pane fade" id="step-1">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-1.php'; ?>

                            </div>
                            <div class="tab-pane fade" id="step-2">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-2.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="step-3">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-3.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="step-4">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-4.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="step-5">
                                <?php include WP_MANGA_DIR . 'admin/first-install/step-5.php'; ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>
</body>
</html>
