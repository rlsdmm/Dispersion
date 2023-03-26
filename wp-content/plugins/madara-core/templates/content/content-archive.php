<?php

	/**
	 * The Template for Manga Item layout, in a loop in Manga Archives page
	 *
	 * This template can be overridden by copying it to your-child-theme/madara-core/content/content-archive.php
	 *
	 * HOWEVER, on occasion Madara will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * we will list any important changes on our theme release logs.
	 * @package Madara
	 * @version 1.7.2.2
	 */
	 
	 use App\Madara;

	$wp_query           = madara_get_global_wp_query();
	$wp_manga           = madara_get_global_wp_manga();
	$wp_manga_setting   = madara_get_global_wp_manga_setting();
	$wp_manga_functions = madara_get_global_wp_manga_functions();
    
	//get ready
	$thumb_size          = array( 110, 150 );
	$madara_loop_index   = get_query_var( 'madara_loop_index' );
	$madara_total_posts  = get_query_var( 'madara_post_count' );
	$madara_page_sidebar = get_query_var( 'sidebar' );

	$manga_hover_details     = Madara::getOption( 'manga_hover_details', 'off' );
	$manga_archives_item_mobile_width = Madara::getOption( 'manga_archives_item_mobile_width', '50' ) == 50 ? false : true;
	$manga_id = get_the_ID();

	$alternative             = $wp_manga_functions->get_manga_alternative( $manga_id );

	$authors                 = $wp_manga_functions->get_manga_authors( $manga_id );
	$chapter_type = get_post_meta( $manga_id, '_wp_manga_chapter_type', true );

	$manga_archives_item_layout = get_query_var('manga_archives_item_layout');
	
	$item_columns = 3;
	if ( $madara_page_sidebar == 'full' ) {
		if($manga_archives_item_layout == 'default' || $manga_archives_item_layout == 'small_thumbnail'){
			$main_col_class = 'col-12 col-md-4';
		} elseif($manga_archives_item_layout == 'big_thumbnail'){
			// big thumbnail layout
			$thumb_size              = ($manga_archives_item_mobile_width ? 'madara_manga_big_thumb_full' : 'madara_manga_big_thumb');
			$main_col_class = 'col-'. ($manga_archives_item_mobile_width ? '12' : '6') .' col-md-2';
			$item_columns = 6;
		} elseif($manga_archives_item_layout == 'simple') {
			$main_col_class = 'col-12';
			$item_columns = 12;
		}
	} else {
		if($manga_archives_item_layout == 'default' || $manga_archives_item_layout == 'small_thumbnail'){
			$main_col_class = 'col-12 col-md-6';
			$item_columns = 2;
		} elseif($manga_archives_item_layout == 'big_thumbnail') {
			// big thumbnail layout
			$thumb_size              = ($manga_archives_item_mobile_width ? 'madara_manga_big_thumb_full' : 'madara_manga_big_thumb');
			$main_col_class = 'col-'. ($manga_archives_item_mobile_width ? '12' : '6') .' col-md-3';
			$item_columns = 4;
		} elseif($manga_archives_item_layout == 'simple') {
			$main_col_class = 'col-12';
			$item_columns = 12;
		}
	}
    
    $thumbnail_link = Madara::getOption('manga_archive_latest_chapter_on_thumbnail', 'off'); // default, ie. link to manga detail
	
	$title_badge_pos = Madara::getOption('manga_badge_position', 1); // 1: before title, 2: before thumbnail
	if ( $madara_loop_index % $item_columns == 1 ) {
?>
<div class="page-listing-item">
    <div class="row row-eq-height">
		<?php
			}
		?>

        <div class="<?php echo esc_attr( $main_col_class ); ?> <?php echo 'badge-pos-' . esc_attr($title_badge_pos);?>">
            <div class="page-item-detail <?php echo esc_attr($chapter_type);?> <?php echo esc_attr($manga_archives_item_mobile_width ? 'fullwidth' : '');?> ">
				<?php 
				if($manga_archives_item_layout == 'simple'){
					get_template_part( 'madara-core/content/content-archive-simple' );
				} else { ?>
                <div id="manga-item-<?php echo esc_attr( $manga_id ); ?>" class="item-thumb <?php echo esc_attr($manga_hover_details == 'off' ? '' : 'hover-details'); ?> c-image-hover" data-post-id="<?php echo esc_attr($manga_id); ?>">
					<?php
						if ( has_post_thumbnail() ) {
                            $link = ($thumbnail_link == 'off' ? get_permalink() : madara_get_latest_chapter_link($manga_id));
							?>
                            <a href="<?php echo esc_url($link); ?>" title="<?php the_title_attribute(); ?>">
								<?php 
                                echo madara_thumbnail( $thumb_size );
                                
                                if($title_badge_pos == 2){
                                        madara_manga_title_badges_html( $manga_id, 1 );
                                }
                                
                                if($thumbnail_link == 'on'){
                                    $total_chapters = get_post_meta($manga_id, 'manga_expected_total', true);
                                    $current_chapters = $wp_manga_functions->get_chapters_count($manga_id);
                                    $text = esc_html__('Chapter %s', 'madara');
                                    if($total_chapters){
                                        $text = sprintf($text, $current_chapters . '/' . $total_chapters);
                                    } else {
                                        $text = sprintf($text, $current_chapters);
                                    }
                                    ?>
                                <span class="quick-chapter-link"><?php echo esc_html($text);?></span>
                                <?php }
                                                                
                                if(Madara::getOption('manga_archives_item_type_text', 'off') == 'on'){?>
                                <span class="manga-type"><?php echo get_post_meta($manga_id, '_wp_manga_type', true);?></span>
                                <?php }?>
                            </a>
							<?php
						}
					?>
                </div>
                <div class="item-summary">
                    <div class="post-title font-title">
                        <h3 class="h5">
							<?php if($title_badge_pos == 1){?>
								<?php madara_manga_title_badges_html( $manga_id, 1 ); ?>
							<?php }?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                    <div class="meta-item rating">
						<?php
							$wp_manga_functions->manga_rating_display( $manga_id );
						?>
                    </div>
                    <div class="list-chapter">
						<?php
							$wp_manga_functions->manga_meta( $manga_id );
						?>
                    </div>
                </div>
				
				<?php } ?>
            </div>

        </div>
		<?php
			if ( ($madara_loop_index % $item_columns == 0 ) || ( $madara_loop_index == $madara_total_posts ) ) {
		?>
    </div>
</div>
<?php
	}