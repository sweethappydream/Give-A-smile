<?php
/**
 * Block Name: Hero Section Block
 * Description: This is the template that displays the custom hero section block.
 * Icon: editor-ol
 * Keywords: custom hero block
 * Supports: { "align":false, "anchor":true }
 *
 * @package unik
 *
 * @var array $block
 */

$block_class = 'custom-hero-section';
$block_id = 'custom-hero-section-' . $block['id'];

$title = get_field('title');
$button_1 = get_field('button_1');
$button_2 = get_field('button_2');
$list_items = get_field('list_items');
$right_column = get_field('right_column');
$left_column = get_field('left_column');
$flexible_content = get_field('flexible_content');
$markup_selection = get_field('markup_selection');
$background_image = get_field('background_image'); 
$background_color = get_field('background_color');
?>
 <!--Start Hero Section-->
 <section class="hero-section" style="
    <?php if (!empty($background_image)) : ?>
        background-image: url('<?php echo $background_image['url']; ?>');
    <?php endif; ?>
    <?php if (!empty($background_color)) : ?>
        background-color: <?php echo $background_color; ?>;
    <?php endif; ?>
">
  <h1><?php echo $title; ?></h1>
  <div class="buttons">
  <?php if (is_array($button_1) && !empty($button_1)): ?>
    <a href="<?php echo $button_1['url']; ?>" role="button" aria-label="<?php echo $button_1['title']; ?>" class="button"><?php echo $button_1['title']; ?></a>
  <?php endif; ?>
  <?php if (is_array($button_2) && !empty($button_2)): ?>
    <a href="<?php echo $button_2['url']; ?>" role="button" aria-label="<?php echo $button_2['title']; ?>" class="button"><?php echo $button_2['title']; ?></a>
  <?php endif; ?>
  </div>
  <?php if (is_array($flexible_content) && !empty($flexible_content)): ?>
  <div class="two-rows">
    <ul class="row1" style="list-style:none;">
    
         <?php
         // Start Left COLUMN
      if ($flexible_content) {
        while (have_rows('flexible_content_left_column')) {
          the_row();
          $item_type = get_row_layout();
          switch ($item_type) {
            
            case 'div_with_text_image_background': // Block With Text, Dark Mode, Background Color and image with heart.
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $image = get_sub_field('image');
              ?>
              <li class="item item-list-with-background withoverlay left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
				  <div class="image-with-heart">
					<img class="image-contain" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
				  </div>
              </li>
              <?php
              break;

            case 'div_with_background_image_span_text_button': //Background Image with text area and button lead to
              $background_image = get_sub_field('background_image');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $button_link_with_icon = get_sub_field('button_link_with_icon');
              
              ?>
              <li class="item item-list-with-background left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <a class="button-with-icon" aria-label="<?= $button_link_with_icon['title'] ?>"href="<?= $button_link_with_icon['url'] ?: '#' ?>"><?= $button_link_with_icon['title'] ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_link':
              $link_url = get_sub_field('link_url');
              $background_image = get_sub_field('background_image');
              ?>
             
              <li class="item item-list-with-background left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>"  style="background-image:url(<?php echo $background_image['url']; ?>);">
              <?php if (!empty($link_url)): ?>
              <a href="<?php echo $link_url; ?>"></a>
              <?php endif; ?>
              </li>
              
              <?php
              break;

            case 'div_with_text_button':
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_text_button':
              $background_image = get_sub_field('background_image');
              $item_title = get_sub_field('title');
              $text = get_sub_field('text');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <p class="description"><?php echo $text; ?></p>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;
              
              case 'background_with_shake_hand_heart_and_title': // Hankdshake div 
                $background_color = get_sub_field('background_color');
                $button_link = get_sub_field('title_with_link');
                $image = get_sub_field('shakedhandsicon');
                ?>
                <li class="item item-list-with-background left-column handshake <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <img class="image-contain-shakeheart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                <?php if (is_array($button_link) && !empty($button_link)): ?>
                <a class="linkhandshake" href="<?= $button_link['url'] ?: '#' ?>" <?= $button_link['target'] ? 'target="_blank" rel="nofollow"' : '' ?> >
                    <?= $button_link['title'] ?>
                </a>
              <?php endif; ?>
                </li>
                <?php
                break;

                case 'background_with_small_text_and_headline':
                  $background_color = get_sub_field('background_color');
                  $small_text = get_sub_field('small_text');
                  $headline = get_sub_field('headline');
                  ?>
                  <li class="item item-list-with-background left-column smallwithspan <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>">
                  <span class="small-text"> <?php echo $small_text; ?> </span>
                  <h3 class="headline-big"> <?php echo $headline; ?> </h3>
                  
                
                  </li>
                  <?php
                  break;

            case 'div_with_span_text_headline':
              $background_color = get_sub_field('background_color');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $headline = get_sub_field('headline');
              ?>
              <li class="item item-list-with-background left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <h2 class="title"><?php echo $headline; ?></h2>
              </li>
              <?php
              break;

            default:
              break;
          }
        }
      }
      ?>
         <?php
         //Start Right Column
      if ($flexible_content) {
        while (have_rows('flexible_content_right_column')) {
          the_row();
          $item_type = get_row_layout();
          switch ($item_type) {
            
            case 'div_with_text_image_background': // Block With Text, Dark Mode, Background Color and image with heart.
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $image = get_sub_field('image');
              ?>
              <li class="item item-list-with-background withoverlay right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
				        <div class="image-with-heart">
					      <img class="image-contain" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
				        </div>
              </li>
              <?php
              break;

                

              case 'background_with_shake_hand_heart_and_title': // Hankdshake div 
                $background_color = get_sub_field('background_color');
                $button_link = get_sub_field('title_with_link');
                $image = get_sub_field('shakedhandsicon');
                ?>
                <li class="item item-list-with-background right-column handshake <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <img class="image-contain-shakeheart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                <?php if (is_array($button_link) && !empty($button_link)): ?>
                <a class="linkhandshake" href="<?= $button_link['url'] ?: '#' ?>" <?= $button_link['target'] ? 'target="_blank" rel="nofollow"' : '' ?> >
                    <?= $button_link['title'] ?>
                </a>
              <?php endif; ?>
                </li>
                <?php
                break;

            case 'div_with_background_image_span_text_button': //Background Image with text area and button lead to
              $background_image = get_sub_field('background_image');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $button_link_with_icon = get_sub_field('button_link_with_icon');
              
              ?>
              <li class="item item-list-with-background right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <a class="button" aria-label="<?= $button_link_with_icon['title'] ?>"href="<?= $button_link_with_icon['url'] ?: '#' ?>"><?= $button_link_with_icon['title'] ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_link':
              $link_url = get_sub_field('link_url');
              $background_image = get_sub_field('background_image');
              ?>
              <li class="item item-list-with-background right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
              <?php if (!empty($link_url)): ?>
              <a href="<?php echo $link_url; ?>"></a>
              <?php endif; ?>
              </li>
              <?php
              break;

            case 'div_with_text_button':
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_text_button':
              $background_image = get_sub_field('background_image');
              $item_title = get_sub_field('title');
              $text = get_sub_field('text');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <p class="description"><?php echo $text; ?></p>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;

              case 'background_with_small_text_and_headline':
                $background_color = get_sub_field('background_color');
                $small_text = get_sub_field('small_text');
                $headline = get_sub_field('headline');
                ?>
                <li class="item item-list-with-background right-column smallwithspan <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>">
                <span class="small-text"> <?php echo $small_text; ?> </span>
                <h3 class="headline-big"> <?php echo $headline; ?> </h3>
                
             
                </li>
                <?php
                break;

            case 'div_with_span_text_headline':
              $background_color = get_sub_field('background_color');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $headline = get_sub_field('headline');
              ?>
              <li class="item item-list-with-background right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <h2 class="title"><?php echo $headline; ?></h2>
              </li>
              <?php
              break;

            default:
              break;
          }
        }
      }
      ?>
		  
		  
    </ul>
    <ul class="last-row">
      <?php
      if ($flexible_content) {
        while (have_rows('flexible_content')) {
          the_row();
          $item_type = get_row_layout();
          switch ($item_type) {
            case 'div_with_text_image_background': // Block With Text, Dark Mode, Background Color and image with heart.
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $image = get_sub_field('image');
              ?>
              <li class="item item-list-with-background withoverlay <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>"  style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
				  <div class="image-with-heart">
					<img class="image-contain" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
				  </div>
              </li>
              <?php
              break;

              
              case 'background_with_shake_hand_heart_and_title': // Hankdshake div 
                $background_color = get_sub_field('background_color');
                $button_link = get_sub_field('title_with_link');
                $image = get_sub_field('shakedhandsicon');
                ?>
                <li class="item item-list-with-background handshake <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <img class="image-contain-shakeheart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                <?php if (is_array($button_link) && !empty($button_link)): ?>
                <a class="linkhandshake" href="<?= $button_link['url'] ?: '#' ?>" <?= $button_link['target'] ? 'target="_blank" rel="nofollow"' : '' ?> >
                    <?= $button_link['title'] ?>
                </a>
              <?php endif; ?>
                </li>
                <?php
                break;

                 
                    
                  case 'background_with_small_text_and_headline':  // Background With small text and headline
                    $background_color = get_sub_field('background_color');
                    $small_text = get_sub_field('small_text');
                    $headline = get_sub_field('headline');
                    ?>
                    <li class="item item-list-with-background smallwithspan <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>">
                    <span class="small-text"> <?php echo $small_text; ?> </span>
                    <h3 class="headline-big"> <?php echo $headline; ?> </h3>
            
                    </li>
                    <?php
                    break;

            case 'div_with_background_image_span_text_button': //Background Image with text area and button lead to
              $background_image = get_sub_field('background_image');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $button_link_with_icon = get_sub_field('button_link_with_icon');
              
              ?>
              <li class="item item-list-with-background <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <a class="button" aria-label="<?=  $button_link_with_icon['title'] ?>"href="<?=  $button_link_with_icon['url'] ?: '#' ?>"><?=  $button_link_with_icon['title'] ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_link':
              $link_url = get_sub_field('link_url');
              $background_image = get_sub_field('background_image');
              ?>
              
              <li class="item item-list-with-background within <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
              <?php if (!empty($link_url)): ?>
              <a href="<?php echo $link_url; ?>"></a>
              <?php endif; ?>
              </li>
              
              <?php
              break;

            case 'div_with_text_button':
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;

            case 'div_with_background_image_text_button':
              $background_image = get_sub_field('background_image');
              $item_title = get_sub_field('title');
              $text = get_sub_field('text');
              $button_link = get_sub_field('button_link');
              $button_text = get_sub_field('button_text');
              ?>
              <li class="item item-list-with-background <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <h2 class="title"><?php echo $item_title; ?></h2>
                <p class="description"><?php echo $text; ?></p>
                <a class="button" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
              </li>
              <?php
              break;

            case 'div_with_span_text_headline':
              $background_color = get_sub_field('background_color');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $headline = get_sub_field('headline');
              ?>
              <li class="item item-list-with-background <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <span><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <h2 class="title"><?php echo $headline; ?></h2>
              </li>
              <?php
              break;

            default:
              break;
          }
        }
      }
      ?>
    </ul>
    <?php endif; ?>
  </div>
</section>

 <!--END Hero Section-->