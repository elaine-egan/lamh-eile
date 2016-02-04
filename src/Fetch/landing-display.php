<?php
namespace StudentStudio\Landing;
carawebs_class_autoloader('Data');
/**
*
* Return data for a landing page.
*
*
* @package StudentStudio
* @subpackage Landing
* @author David Egan <david@carawebs.com>
*
*/
class Display {

  /**
   * Associated workbook (a product)
   * @var array
   */
  private $workbook;

  /**
   * Markup for call to action
   * @var string
   */
  private $cta;

  public function __construct ( $post_ID ) {

    $this->post_ID = $post_ID;
    $this->set_workbook();
    $this->set_cta();

  }

  private function set_workbook() {

    // If the landing page promotes a particular product, this will return the relevant post ID for the product
    $workbook_ID = get_post_meta( $this->post_ID, 'associated_workbook', true );

    if ( !empty( $workbook_ID ) ) {

      $this->workbook = [
        'workbook_ID' => $workbook_ID,
        'title'       => get_the_title( $workbook_ID ),
        'url'         => '/checkout?edd_action=add_to_cart&download_id=' . $workbook_ID
      ];

    }

  }

  private function set_cta() {

    if ( !empty( $this->workbook['workbook_ID'] ) ) {

      ob_start();
      ?>
      <div class="text-center">
        <a class="btn btn-default btn-md" href="<?= esc_url( home_url( $this->workbook['url'] ) ); ?>" title="<?= $this->workbook['title']; ?>">
          Purchase <?= $this->workbook['title']; ?>Workbook
        </a>
      </div>
      <?php

      $this->cta = ob_get_clean();

    } else {

      ob_start();
      ?>
      <div class="text-center">
        <a class="btn btn-default btn-md" href="<?= esc_url( home_url( '/buy-workbooks' ) ); ?>" title="Buy Workbooks">
          Purchase Workbooks
        </a>
      </div>
      <?php

      $this->cta = ob_get_clean();

    }

  }

  /**
   * Build data for flexible content blocks
   *
   * @param  string|int $post_ID    The current post ID
   * @return string     $flex_field The name of the flexible content field
   */
  public function the_flexible_content ( $flex_field = 'flexible_content' ) {

    $post_ID = $this->post_ID;

    // Array of flexible content
    $rows = get_post_meta( $post_ID, $flex_field, true );

    if ( !$rows ) {

      return;

    }

    $row_data = '';

    foreach( (array)$rows as $count => $subfield) {

      switch ( $subfield ) {
        case 'emphasis_text':

          $row_data .= $this->the_emphasis_text( $post_ID, $flex_field, $count );

          break;

        case 'image_section':

          $row_data .= $this->the_text_image_section( $post_ID, $flex_field, $count );

          break;

        case 'testimonials':

          $row_data .= $this->the_testimonials( $post_ID, $flex_field, $count );

          break;

        case 'image_block':

          $row_data .= $this->the_image( $post_ID, $flex_field, $count );

          break;

      }

    }

    echo $row_data;

  }

  /**
   * Build markup for image with subheading , text paragraph and optional call to action
   *
   * @param  string|int $post_ID    The post ID of this page
   * @param  string     $flex_field The ACF flexible content field
   * @param  int        $count      The flexible field placement counter
   * @return string                 Image markup
   */
  private function the_image( $post_ID, $flex_field, $count ) {

    // The section title
    $title = get_post_meta( $post_ID, $flex_field . '_' . $count . '_subheading', true );

    // The content (set by ACF textarea field) for this section
    $content = apply_filters( 'text', get_post_meta( $post_ID, $flex_field . '_' . $count . '_text_content', true ) );

    // Call to Action
    $include_cta = get_post_meta( $post_ID, $flex_field . '_' . $count . '_call_to_action', true );

    // The image ID for this section
    $image_ID = get_post_meta( $post_ID, $flex_field . '_' . $count . '_image', true );

    // The image markup
    $img_html = \StudentStudio\Fetch\Data::get_image( $image_ID, 'full' );

    ob_start()
    ?>
    <div class="section outer-container">
      <div class="full-width">
        <?= $img_html; ?>
      </div>
      <div class="inner-container text-center">
        <h2><?= $title; ?></h2>
        <p><?= $content; ?></p>
        <?php
        if( '1' === $include_cta ) {

          echo $this->cta;

        }

      ?>
      </div>
    </div>
    <?php

    return ob_get_clean();

  }

  /**
   * Build a testimonials block
   *
   * @param  string|int $post_ID    The post ID for this landing page
   * @param  string     $flex_field The ACF flexible content field
   * @param  int        $count      The flexible field placement counter
   * @return string                 Testimonials markup
   */
  private function the_testimonials( $post_ID, $flex_field, $count ){

    $fieldname = $flex_field . '_' . $count . '_testimonial';
    $image     = ['image_ID','full'];

    $subfields = [
      'short_text'  => 'text',
      'long_text'   => 'text',
      'image'       => $image,
      'name'        => 'text',
      'company'     => 'text'
    ];

    $data = \StudentStudio\Fetch\Data::acf_repeater( $post_ID, $fieldname, $subfields );

    ob_start();
    ?>
    <div class="container">
      <div class="row">
        <?php
        foreach ( $data as $testimonial ) {

          $image = !empty( $testimonial['image']['url'] ) ? $testimonial['image'] : null;

          ?>
          <div class="col-md-4">
            <div class="testimonial text-center">
              <h2><?= $testimonial['short_text']; ?></h2>
              <?php
              if( !empty ( $image ) ){
                echo "<img src='{$testimonial['image']['url']}' class='img-responsive img-circle' title='{$testimonial['image']['title']}' alt='{$testimonial['image']['title']}' height='{$testimonial['image']['height']}' width='{$testimonial['image']['width']}'>";
              }
              ?>
              <?= $testimonial['long_text']; ?>
              <br>
              <?= $testimonial['name']; ?><br>
              <?= $testimonial['company']; ?>

            </div>
          </div>
          <?php

        }
        ?>
      </div>
    </div>
    <?php
    return ob_get_clean();

  }

  /**
   * Build an emphasis text block
   *
   * @param  string|int  $post_ID    The post ID
   * @param  string      $flex_field The ACF flexible content field
   * @param  int         $count      The flexible field placement counter
   * @return string      HTML for emphasis text block
   */
  private function the_emphasis_text( $post_ID, $flex_field, $count ) {

    $field = $flex_field . '_' . $count . '_text_content';

    $content = get_post_meta( $post_ID, $field, true );

    // Call to Action
    $include_cta = get_post_meta( $post_ID, $flex_field . '_' . $count . '_call_to_action', true );

    ob_start();

    ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="lead text-center">
              <?php
              echo $content;

              if( '1' === $include_cta ) {
                ?>
                <div class="topspace">
                  <?= $this->cta; ?>
                </div>
                <?php

              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php

    return ob_get_clean();

  }

  /**
   * Build HTML for a text + image + title section
   *
   * The field names are `section_title`, `section_content` and `image`.
   * `section_title` is a text field, `section_content` is a wysiwyg field and `image`
   * returns an image ID.
   *
   * @param  int|string $post_ID    The post ID
   * @param  string     $flex_field The flexible layout field name
   * @param  int        $count      Flexible layout field count
   * @return string                 HTML for this section
   */
  private function the_text_image_section( $post_ID, $flex_field, $count ) {

    // The section title
    $title = get_post_meta( $post_ID, $flex_field . '_' . $count . '_section_title', true );

    // The content (set by ACF wysiwyg field) for this section
    $content = apply_filters( 'the_content', get_post_meta( $post_ID, $flex_field . '_' . $count . '_section_content', true ) );

    // The image ID for this section
    $image_ID = get_post_meta( $post_ID, $flex_field . '_' . $count . '_image', true );

    // Either 'image-right' (default) or 'image-left'
    $layout = get_post_meta( $post_ID, $flex_field . '_' . $count . '_layout', true );

    // The image markup
    $img_html = \StudentStudio\Fetch\Data::get_image( $image_ID, 'full' );

    // '1' indicates that a purchase link should be included in this block
    $include_cta = get_post_meta( $post_ID, $flex_field . '_' . $count . '_purchase_link', true );

    $layout_push = 'image-left' === $layout ? ' col-md-push-6' : null;
    $layout_pull = 'image-left' === $layout ? ' col-md-pull-6' : ' col-md-offset-1';

    ob_start()
    ?>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-6<?= $layout_push ;?>">
            <h2><?= $title; ?></h2>
            <?= $content; ?>
          </div>
          <div class="col-md-5<?= $layout_pull ;?>">
            <?= $img_html; ?>
            <?php

              if ( '1' === $include_cta ) {
                ?>
              <div class="text-center">
                <?= $this->cta; ?>
              </div>

            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php

    return ob_get_clean();

  }

}
