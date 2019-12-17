<?php
/**
 *  Shortcode template for displaying the FAQ list within a page.
 *
 * @param      <type> <parameter_name> { parameter_description }
 */
?>
<div class="faq-wrapper">
  <h2 class="center">Frequently Asked Questions</h2>
  <h3 class="center">Fleetguard $50 Cash Back Program</h3>
  <div class="faq-section">
    <?php
    foreach ( $faq_list as $faq ) {
      $position = get_post_meta( $faq->ID, 'faq_position', true );
      $question = $faq->post_title;
      $answer = $faq->post_content;
      ?>
      <div class="faq-block">
        <strong><?= "{$position}. {$question}" ?></strong>
        <p><?= $answer; ?></p>
      </div>
      <?php
    } ?>
  </div><!-- /.faq-section -->
</div><!-- /.faq-wrapper -->