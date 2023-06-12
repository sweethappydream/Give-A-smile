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
      if ($flexible_content) { // Check if we have flexible content
        while (have_rows('flexible_content_left_column')) {
          the_row();
          $item_type = get_row_layout();
          switch ($item_type) {
            
            case 'background_colortitle_and_image_with_heart': // Block With Text, Dark Mode, Background Color and image with heart.
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

            case 'background_image_with_text_area_and_button_lead_to': //Background Image with text area and button lead to
              $background_image = get_sub_field('background_image');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text');
              $button_link_with_icon = get_sub_field('button_link_with_icon');
              
              ?>
              <li class="item item-list-with-background-image left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <span class="pink-s"><?php echo $span_text; ?></span>
                <p class="description"><?php echo $text; ?></p>
                <a href="<?php echo $button_link_with_icon['url']; ?>" aria-label="<?php echo $button_link_with_icon['title']; ?>" class="button-with-image"><?php echo $button_link_with_icon['title']; ?></a>
              </li>
              <?php
              break;

              case 'background_with_small_text_and_headline': // Block Background color, small text, Headline h3 
                $background_color = get_sub_field('background_color');
                $small_text = get_sub_field('small_text');
                $headline = get_sub_field('headline');
                ?>
                <li class="item item-list-with-background left-column smallwithspan <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <span class="small-text"> <?php echo $small_text; ?> </span>
                <h3 class="headline-big"> <?php echo $headline; ?> </h3>
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

                case 'background_image_with_project_of_the_month': //Background Image with project of the month
                  $background_image = get_sub_field('background_image');
                  $image = get_sub_field('icon');
                  $project_of_the_month = get_sub_field('project_of_the_month');
                  
                  ?>
                  <li class="item item-list-with-background-image project-month left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                  <div class="overlay-project-themonth">
                  <img class="p-month-heart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                  <span class="small-text-month"><?php _e('Project of the month:', THEME_TD); ?></span>
                  <span class="small-text-month"><?php _e('Project of the month:', THEME_TD); ?></span>
                      <a href="<?php echo $project_of_the_month['url']; ?>" aria-label="<?php echo $project_of_the_month['title']; ?>" class="title-button"><?php echo $project_of_the_month['title']; ?></a>
                  </div>
                  </li>
                  <?php
                  break;

            case 'background_with_image_overlay_text_area_and_button': //Background with Image, Overlay, Text Area and button
              $background_image = get_sub_field('background_image');
              $span_text = get_sub_field('span_text');
              $text = get_sub_field('text_area');
              $button_link = get_sub_field('button_link');
              ?>
              <li class="item item-list-with-background within left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                <p class="description"><?php echo $text; ?></p>
                <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
              </li>
              <?php
              break;

              case 'background_with_text_area_and_button': //Background with Text Area and button
                $background_color = get_sub_field('background_color');
                $text = get_sub_field('text_area');
                $button_link = get_sub_field('button_link');
                ?>
                <li class="item item-list-with-background-color left-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                  <p class="description"><?php echo $text; ?></p>
                  <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-svg">
                  <?php echo $button_link['title']; ?>
                  <span class="icon-container">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16.495" height="17.737" viewBox="0 0 16.495 17.737">
                  <g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right" transform="translate(-6 -5.379)">
                  <path id="Path_413" data-name="Path 413" d="M7.5,18H20.995" transform="translate(0 -3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                  <path id="Path_414" data-name="Path 414" d="M18,7.5l6.747,6.747L18,20.995" transform="translate(-3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                  </g>
                  </svg>
                </span>
                  </a>

                </li>
                <?php
                break;

                case 'background_image_overlay_taxonamy_and_button': //Background with Image, Overlay, Taxonomy Area and button
                  $background_image = get_sub_field('background_image');
                  $taxonomy_term = get_sub_field('taxonomy_field'); 
                  $button_link = get_sub_field('button_link');
                    $term_name = $taxonomy_term->name; // Get the name of the taxonomy term
                    ?>
                    <li class="item item-list-with-background within justify-space left-column" style="background-image: url(<?php echo $background_image['url']; ?>);">
                      <span class="taxonomy-button"><?php echo $term_name; ?></span>
                      <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                    </li>
                    <?php
                  break;
                
                  case 'voucher_block': //Voucher Block
                    $span_text = get_sub_field('voucher_text');
                    $donate_text = get_sub_field('donate_text');
                    $price_text = get_sub_field('price_text');
                    $button_link = get_sub_field('button_link');
                    $currency = get_woocommerce_currency_symbol();
                       ?>
                      <li class="item item-list-with-background voucher left-column">
                        <span class="voucher-span"><?php echo $span_text; ?></span>
                        <span class="voucher-donate"><?php echo $donate_text; ?></span>
                        <span class="price-text"><?php echo $price_text; ?> <?php echo $currency; ?> </span>
                        <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
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
        while (have_rows('flexible_content_right_column')) {
          the_row();
          $item_type = get_row_layout();
          switch ($item_type) {
            
            case 'background_colortitle_and_image_with_heart': // Block With Text, Dark Mode, Background Color and image with heart.
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

              case 'background_image_with_text_area_and_button_lead_to': //Background Image with text area and button lead to
                $background_image = get_sub_field('background_image');
                $span_text = get_sub_field('span_text');
                $text = get_sub_field('text');
                $button_link_with_icon = get_sub_field('button_link_with_icon');
                
                ?>
                <li class="item item-list-with-background-image right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                  <span class="pink-s"><?php echo $span_text; ?></span>
                  <p class="description"><?php echo $text; ?></p>
                  <a href="<?php echo $button_link_with_icon['url']; ?>" aria-label="<?php echo $button_link_with_icon['title']; ?>" class="button-with-image"><?php echo $button_link_with_icon['title']; ?></a>
                </li>
                <?php
                break;
            
                case 'background_with_small_text_and_headline': // Block Background color, small text, Headline h3 
                  $background_color = get_sub_field('background_color');
                  $small_text = get_sub_field('small_text');
                  $headline = get_sub_field('headline'); 
                  ?>
                  <li class="item item-list-with-background right-column smallwithspan <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                  <span class="small-text"> <?php echo $small_text; ?> </span>
                  <h3 class="headline-big"> <?php echo $headline; ?> </h3>
                  </li>
                  <?php
                  break;

                  case 'background_image_with_project_of_the_month': //Background Image with project of the month
                    $background_image = get_sub_field('background_image');
                    $image = get_sub_field('icon');
                    $project_of_the_month = get_sub_field('project_of_the_month');
                    
                    ?>
                    <li class="item item-list-with-background-image project-month right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                    <div class="overlay-project-themonth">
                    <img class="p-month-heart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                    <span class="small-text-month"><?php _e('Project of the month:', THEME_TD); ?></span>
                      <a href="<?php echo $project_of_the_month['url']; ?>" aria-label="<?php echo $project_of_the_month['title']; ?>" class="title-button"><?php echo $project_of_the_month['title']; ?></a>
                    </div>
                    </li>
                    <?php
                    break;

                    case 'background_with_image_overlay_text_area_and_button': //Background with Image, Overlay, Text Area and button
                      $background_image = get_sub_field('background_image');
                      $span_text = get_sub_field('span_text');
                      $text = get_sub_field('text_area');
                      $button_link = get_sub_field('button_link');
                      ?>
                      <li class="item item-list-with-background within right-column<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                        <p class="description"><?php echo $text; ?></p>
                        <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                      </li>
                      <?php
                      break;

                      case 'background_with_text_area_and_button': //Background with Text Area and button
                        $background_color = get_sub_field('background_color');
                        $text = get_sub_field('text_area');
                        $button_link = get_sub_field('button_link');
                        ?>
                        <li class="item item-list-with-background-color right-column <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                          <p class="description"><?php echo $text; ?></p>
                          <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-svg">
                          <?php echo $button_link['title']; ?>
                          <span class="icon-container">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16.495" height="17.737" viewBox="0 0 16.495 17.737">
                          <g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right" transform="translate(-6 -5.379)">
                          <path id="Path_413" data-name="Path 413" d="M7.5,18H20.995" transform="translate(0 -3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                          <path id="Path_414" data-name="Path 414" d="M18,7.5l6.747,6.747L18,20.995" transform="translate(-3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                          </g>
                          </svg>
                        </span>
                          </a>
        
                        </li>
                        <?php
                        break;

                        case 'background_image_overlay_taxonamy_and_button': //Background with Image, Overlay, Taxonomy Area and button
                          $background_image = get_sub_field('background_image');
                          $taxonomy_term = get_sub_field('taxonomy_field'); 
                          $button_link = get_sub_field('button_link');
                            $term_name = $taxonomy_term->name; // Get the name of the taxonomy term
                            ?>
                            <li class="item item-list-with-background within justify-space left-column" style="background-image: url(<?php echo $background_image['url']; ?>);">
                              <span class="taxonomy-button"><?php echo $term_name; ?></span>
                              <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                            </li>
                            <?php
                          break;
                        
                          case 'voucher_block': //Voucher Block
                            $span_text = get_sub_field('voucher_text');
                            $donate_text = get_sub_field('donate_text');
                            $price_text = get_sub_field('price_text');
                            $button_link = get_sub_field('button_link');
                            $currency = get_woocommerce_currency_symbol();
                               ?>
                              <li class="item item-list-with-background voucher left-column">
                                <span class="voucher-span"><?php echo $span_text; ?></span>
                                <span class="voucher-donate"><?php echo $donate_text; ?></span>
                                <span class="price-text"><?php echo $price_text; ?> <?php echo $currency; ?> </span>
                                <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                              </li>
                              <?php
                            break;
        
            default:
              break;
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
          
            case 'background_colortitle_and_image_with_heart': // Block With Text, Dark Mode, Background Color and image with heart.
              $background_color = get_sub_field('background_color');
              $item_title = get_sub_field('title');
              $image = get_sub_field('image');
              ?>
              <li class="item item-list-with-background withoverlay<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                <h2 class="title"><?php echo $item_title; ?></h2>
				        <div class="image-with-heart">
					      <img class="image-contain" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
				        </div>
              </li>
              <?php
              break;

              case 'background_image_with_text_area_and_button_lead_to': //Background Image with text area and button lead to
                $background_image = get_sub_field('background_image');
                $span_text = get_sub_field('span_text');
                $text = get_sub_field('text');
                $button_link_with_icon = get_sub_field('button_link_with_icon');
                
                ?>
                <li class="item item-list-with-background-image <?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                  <span class="pink-s"><?php echo $span_text; ?></span>
                  <p class="description"><?php echo $text; ?></p>
                  <a href="<?php echo $button_link_with_icon['url']; ?>" aria-label="<?php echo $button_link_with_icon['title']; ?>" class="button-with-image"><?php echo $button_link_with_icon['title']; ?></a>
                </li>
                <?php
                break;
             
                case 'background_with_small_text_and_headline': // Block Background color, small text, Headline h3 
                  $background_color = get_sub_field('background_color');
                  $small_text = get_sub_field('small_text');
                  $headline = get_sub_field('headline');
                  ?>
                  <li class="item item-list-with-background smallwithspan<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                  <span class="small-text"> <?php echo $small_text; ?> </span>
                  <h3 class="headline-big"> <?php echo $headline; ?> </h3>
                  </li>
                  <?php 
                  break;

                  case 'background_image_with_project_of_the_month': //Background Image with project of the month
                    $background_image = get_sub_field('background_image');
                    $image = get_sub_field('icon');
                    $project_of_the_month = get_sub_field('project_of_the_month');
                    
                    ?>
                    <li class="item item-list-with-background-image project-month<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                    <div class="overlay-project-themonth">
                    <img class="p-month-heart" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">  
                    <span class="small-text-month"><?php _e('Project of the month:', THEME_TD); ?></span>
                      <a href="<?php echo $project_of_the_month['url']; ?>" aria-label="<?php echo $project_of_the_month['title']; ?>" class="title-button"><?php echo $project_of_the_month['title']; ?></a>
                    </div>
                    </li>
                    <?php
                    break;

                    case 'background_with_image_overlay_text_area_and_button': //Background with Image, Overlay, Text Area and button
                      $background_image = get_sub_field('background_image');
                      $span_text = get_sub_field('span_text');
                      $text = get_sub_field('text_area');
                      $button_link = get_sub_field('button_link');
                      ?>
                      <li class="item item-list-with-background within<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-image: url(<?php echo $background_image['url']; ?>);">
                        <p class="description"><?php echo $text; ?></p>
                        <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                      </li>
                      <?php
                      break;


                      case 'background_with_text_area_and_button': //Background with Text Area and button
                        $background_color = get_sub_field('background_color');
                        $text = get_sub_field('text_area');
                        $button_link = get_sub_field('button_link');
                        ?>
                        <li class="item item-list-with-background-color<?php echo (get_sub_field('dark_mode') ? 'dark_mode' : ''); ?>" style="background-color: <?php echo $background_color; ?>;">
                          <p class="description"><?php echo $text; ?></p>
                          <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-svg">
                          <?php echo $button_link['title']; ?>
                          <span class="icon-container">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16.495" height="17.737" viewBox="0 0 16.495 17.737">
                          <g id="Icon_feather-arrow-right" data-name="Icon feather-arrow-right" transform="translate(-6 -5.379)">
                          <path id="Path_413" data-name="Path 413" d="M7.5,18H20.995" transform="translate(0 -3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                          <path id="Path_414" data-name="Path 414" d="M18,7.5l6.747,6.747L18,20.995" transform="translate(-3.753)" fill="none" stroke="#0e1c42" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                          </g>
                          </svg>
                        </span>
                          </a>
        
                        </li>
                        <?php
                        break;

                        case 'background_image_overlay_taxonamy_and_button': //Background with Image, Overlay, Taxonomy Area and button
                          $background_image = get_sub_field('background_image');
                          $taxonomy_term = get_sub_field('taxonomy_field'); 
                          $button_link = get_sub_field('button_link');
                            $term_name = $taxonomy_term->name; // Get the name of the taxonomy term
                            ?>
                            <li class="item item-list-with-background within justify-space left-column" style="background-image: url(<?php echo $background_image['url']; ?>);">
                              <span class="taxonomy-button"><?php echo $term_name; ?></span>
                              <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
                            </li>
                            <?php
                          break;
                        
                          case 'voucher_block': //Voucher Block
                            $span_text = get_sub_field('voucher_text');
                            $donate_text = get_sub_field('donate_text');
                            $price_text = get_sub_field('price_text');
                            $button_link = get_sub_field('button_link');
                            $currency = get_woocommerce_currency_symbol();
                               ?>
                              <li class="item item-list-with-background voucher left-column">
                                <span class="voucher-span"><?php echo $span_text; ?></span>
                                <span class="voucher-donate"><?php echo $donate_text; ?></span>
                                <span class="price-text"><?php echo $price_text; ?> <?php echo $currency; ?> </span>
                                <a href="<?php echo $button_link['url']; ?>" aria-label="<?php echo $button_link['title']; ?>" class="title-button-with-icon"><?php echo $button_link['title']; ?></a>
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