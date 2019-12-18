<?php
/**
 * Template for metabox on claim CPT allowing to save/see metadata
 */
  // $claim = array(
  //   'first-name',
  //   'last-name',
  //   'company-name',
  //   'mobile',
  //   'email',
  //   'address-1',
  //   'address-2',
  //   'suburb',
  //   'claim-state',
  //   'postcode',
  //   'claim-date',
  //   'terms'
  // );

  // $purchase = array(
  //   "purchase-date",
  //   "purchase-state",
  //   "purchase-location",
  //   "invoice-number",
  //   "invoice-img"
  // );

$states = array('NSW', 'QLD', 'VIC', 'WA', 'SA', 'TAS');
?>
<h4>Personal Details</h4>
<div class="row">
  <div class="half">
    <label>First Name</label>
    <input type="text" name="first-name" required="required">
  </div>
  <div class="half">
    <label>Last Name</label>
    <input type="text" name="last-name" required="required">
  </div>
</div>
<div class="row">
  <label>Company Name</label>
  <input type="text" name="company-name">
</div>
<div class="row">
  <div class="half">
    <label>Mobile</label>
    <input type="tel" name="mobile" required="required">
  </div>
  <div class="half">
    <label>Email</label>
    <input type="email" name="email" required="required">
  </div>
</div>
<div class="row">
  <label>Address 1</label>
  <input type="text" name="address-1" required="required">
</div>
<div class="row">
  <label>Address 2</label>
  <input type="text" name="address-2">
</div>
<div class="row">
  <div class="half">
    <label>Suburb</label>
    <input type="text" name="suburb" required="required">
  </div>
  <div class="half">
    <label>Claim State</label>
    <select name="claim-state" required="required">
      <?php foreach ($states as $state) { ?>
        <option value="<?= $state ?>"><?= $state ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="row">
  <div class="half">
    <label>Postcode</label>
    <input type="number" name="postcode" required="required">
  </div>
  <div class="half">
    <label>Claim Date</label>
    <input type="date" name="claim-date" required="required">
  </div>
</div>
<div class="row">
  <label><input type="checkbox" name="terms" required="required">Terms and conditions agreed to</label>
</div>
<hr>
<h4>Purchase Details</h4>
<div class="row">
  <div class="half">
    <label>Purchase Date</label>
    <input type="text" name="purchase-date" required="required">
  </div>
  <div class="half">
    <label>Purchase State</label>
    <select name="purchase-state" required="required">
      <?php foreach ($states as $state) { ?>
        <option value="<?= $state ?>"><?= $state ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="row">
  <div class="half">
    <label>Purchase Location</label>
    <input type="text" name="purchase-location">
  </div>
  <div class="half">
    <label>Invoice Number</label>
    <input type="text" name="invoice-number" required="required">
  </div>
</div>
