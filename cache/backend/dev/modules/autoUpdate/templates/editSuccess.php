<?php use_helper('I18N', 'Date') ?>
<?php include_partial('update/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Update', array(), 'messages') ?></h1>

  <?php include_partial('update/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('update/form_header', array('stackapp_affiliate' => $stackapp_affiliate, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('update/form', array('stackapp_affiliate' => $stackapp_affiliate, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('update/form_footer', array('stackapp_affiliate' => $stackapp_affiliate, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
