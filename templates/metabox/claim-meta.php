<?php
/**
 * Template for metabox on claim CPT allowing to save/see metadata
 */

// array of form fields for helper functions ( input_field() and state_select() )
// format is '<meta_key>' => array( 'key' => '<meta_key>', 'label' => '<label string>', 'type' => '<input type>', 'required' => <bool> ),
$meta_fields = array(
  'first-name' => array( 'key' => 'first-name', 'label' => 'First Name', 'type' => 'text', 'required' => true ),
  'last-name' => array( 'key' => 'last-name', 'label' => 'Last Name', 'type' => 'text', 'required' => true ),
  'company-name' => array( 'key' => 'company-name', 'label' => 'Company', 'type' => 'text', 'required' => false ),
  'mobile' => array( 'key' => 'mobile', 'label' => 'Mobile', 'type' => 'tel', 'required' => true ),
  'email' => array( 'key' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true ),
  'address-1' => array( 'key' => 'address-1', 'label' => 'Address 1', 'type' => 'text', 'required' => true ),
  'address-2' => array( 'key' => 'address-2', 'label' => 'Address 2', 'type' => 'text', 'required' => false ),
  'suburb' => array( 'key' => 'suburb', 'label' => 'Suburb', 'type' => 'text', 'required' => true ),
  'claim-state' => array( 'key' => 'claim-state', 'label' => 'Claim State', 'type' => 'select', 'required' => true ),
  'postcode' => array( 'key' => 'postcode', 'label' => 'Postcode', 'type' => 'text', 'required' => true ),
  'claim-date' => array( 'key' => 'claim-date', 'label' => 'Date of Claim', 'type' => 'date', 'required' => true ),
  'terms' => array( 'key' => 'terms', 'label' => 'Agreed to terms', 'type' => 'checkbox', 'required' => true ),
  "purchase-date" => array( 'key' => "purchase-date", 'label' => 'Date of Purchase', 'type' => 'date', 'required' => true ),
  "purchase-state" => array( 'key' => "purchase-state", 'label' => 'State of Purchase', 'type' => 'select', 'required' => true ),
  "purchase-location" => array( 'key' => "purchase-location", 'label' => 'Purchase Location', 'type' => 'text', 'required' => false ),
  "invoice-number" => array( 'key' => "invoice-number", 'label' => 'Invoice Number', 'type' => 'text', 'required' => true ),
  "invoice-img" => array( 'key' => "invoice-img", 'label' => 'Uploaded Invoice', 'type' => 'file', 'required' => true ),
);

function input_field( $meta_field ) {
  global $post_id;
  $value = get_post_meta($post_id, $meta_field['key'], true) ?? '';
  ?>
  <label><?= $meta_field['label'] ?></label>
  <input type="<?= $meta_field['type'] ?>" name="<?= $meta_field['key'] ?>" value="<?= $value ?>"<?= $meta_field['required'] ? ' required' : '' ?>>
<?php }

function state_select( $meta_field ) {
  global $post_id;
  $states = array('NSW', 'QLD', 'VIC', 'WA', 'SA', 'TAS');
  $value = get_post_meta($post_id, $meta_field['key'], true) ?? '';
  ?>
    <label><?= $meta_field['label'] ?></label>
    <select name="<?= $meta_field['key'] ?>" <?= $meta_field['required'] ? 'required ' : '' ?>>
      <?php foreach ($states as $state) { ?>
        <option value="<?= $state ?>" <?= selected( $meta_field['key'], $state, true, 'selected' ) ?>><?= $state ?></option>
      <?php } ?>
    </select>
  <?php }
?>
<h4>Personal Details</h4>
<div class="row">
  <div class="half">
    <?php input_field( $meta_fields['first-name']); ?>
  </div>
  <div class="half">
    <?php input_field( $meta_fields['last-name']); ?>
  </div>
</div>
<div class="row">
  <?php input_field( $meta_fields['company-name']); ?>
</div>
<div class="row">
  <div class="half">
    <?php input_field( $meta_fields['mobile']); ?>
  </div>
  <div class="half">
    <?php input_field( $meta_fields['email']); ?>
  </div>
</div>
<div class="row">
  <?php input_field( $meta_fields['address-1']); ?>
</div>
<div class="row">
  <?php input_field( $meta_fields['address-2']); ?>
</div>
<div class="row">
  <div class="half">
    <?php input_field( $meta_fields['suburb']); ?>
  </div>
  <div class="half">
    <?= state_select( $meta_fields['claim-state'] ) ?>
  </div>
</div>
<div class="row">
  <div class="half">
    <?php input_field( $meta_fields['postcode']); ?>
  </div>
  <div class="half">
    <?php input_field( $meta_fields['claim-date']); ?>
  </div>
</div>
<div class="row">
  <label><input type="checkbox" name="terms" required="required">Terms and conditions agreed to</label value="">
  </div>
  <hr>
  <h4>Purchase Details</h4>
  <div class="row">
    <div class="half">
      <?php input_field( $meta_fields['purchase-date']); ?>
    </div>
    <div class="half">
      <?= state_select( $meta_fields['purchase-state'] ) ?>
    </div>
  </div>
  <div class="row">
    <div class="half">
      <?php input_field( $meta_fields['purchase-location']); ?>
    </div>
    <div class="half">
      <?php input_field( $meta_fields['invoice-number']); ?>
    </div>
  </div>
