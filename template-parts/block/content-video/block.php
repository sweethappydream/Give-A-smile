<?php

/**
 * Block Name: Content Video
 * Description: Content Video
 * Icon: align-pull-right
 * Keywords: content video block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$slug = 'content-video';
$blockId = $block['anchor'] ?? null;
$blockClass = $block['className'] ?? null;
$videoSettings = get_field('video_settings');
?>
<link href="https://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.12/video.js"></script>
<section <?= $blockId ? 'id="' . $blockId . '"' : '' ?> class="<?= $slug ?> <?= $blockClass ?: '' ?> bg-gray">
    <div class="container">
        <div class="flex-row">
            <div class="<?= $slug . '__content' ?> flex-col">
                <h1 class="block-title"><?php the_field( 'title' ); ?></h1>
                <?php the_field( 'content' ); ?>
            </div>
            <div class="<?= $slug . '__video' ?> flex-col">
                <?php if ( have_rows( 'images_list' ) ) : ?>
                    <?php while ( have_rows( 'images_list' ) ) : the_row(); ?>
                    <div class="img-circle">
                        <?php $image1 = get_sub_field( 'image1' ); ?>
                        <?php if ( $image1 ) : ?>
                            <img src="<?php echo esc_url( $image1['url'] ); ?>" alt="<?php echo esc_attr( $image1['alt'] ); ?>" />
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'video_settings' ) ) : ?>
                    <?php while ( have_rows( 'video_settings' ) ) : the_row(); ?>
                    <div class="img-circle video-link">
                        <?php $video_placeholder_image = get_sub_field( 'video_placeholder_image' ); ?>
                        <?php if ( $video_placeholder_image ) : ?>
                            <img src="<?php echo esc_url( $video_placeholder_image['url'] ); ?>" alt="<?php echo esc_attr( $video_placeholder_image['alt'] ); ?>" />
                        <?php endif; ?>
                        <?php if ($videoSettings['video_type'] == 'iframe'): ?>
                            <a href="#" data-lg-size="1280-720"
                               data-iframe="true" data-src="<?= $videoSettings['iframe_code']; ?>">
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play.svg" alt="play1">
                            </a>
                        <?php else: ?>
                            <a
                                data-video='{"source": [{"src":"<?= $videoSettings['upload_video']['url'] ?>", "type": "video/mp4"}]}'>
                                <img src="<?= get_template_directory_uri(); ?>/assets/img/play.svg" alt="<?= $videoSettings['upload_video']['title'] ?>">
                            </a>

                        <?php endif; ?>

                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ( have_rows( 'images_list' ) ) : ?>
                <?php while ( have_rows( 'images_list' ) ) : the_row(); ?>
                <div class="img-circle">
                    <?php $image2 = get_sub_field( 'image2' ); ?>
                    <?php if ( $image2 ) : ?>
                        <img src="<?php echo esc_url( $image2['url'] ); ?>" alt="<?php echo esc_attr( $image2['alt'] ); ?>" />
                    <?php endif; ?>
                </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="scroll-wrapper">
        <a href="#" class="btn btn-scroll">
            <span><?php the_field( 'button_title' ); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="14" viewBox="0 0 23 14" fill="none">
                <path d="M22.0892 1.08923C21.3107 0.310686 20.0486 0.309998 19.2692 1.08769L11.5 8.84L3.73077 1.08769C2.95137 0.309998 1.68931 0.310687 0.910768 1.08923C0.131622 1.86838 0.131622 3.13162 0.910769 3.91077L10.0858 13.0858C10.8668 13.8668 12.1332 13.8668 12.9142 13.0858L22.0892 3.91077C22.8684 3.13162 22.8684 1.86838 22.0892 1.08923Z" fill="white"/>
            </svg>
        </a>
    </div>
</section>
