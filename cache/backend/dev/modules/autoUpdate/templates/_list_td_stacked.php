<td colspan="3">
  <?php echo __('%%is_active%% - %%email%% - %%token%%', array('%%is_active%%' => get_partial('update/list_field_boolean', array('value' => $stackapp_affiliate->getIsActive())), '%%email%%' => $stackapp_affiliate->getEmail(), '%%token%%' => $stackapp_affiliate->getToken()), 'messages') ?>
</td>
