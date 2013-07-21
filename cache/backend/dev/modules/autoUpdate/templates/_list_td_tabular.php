<td class="sf_admin_boolean sf_admin_list_td_is_active">
  <?php echo get_partial('update/list_field_boolean', array('value' => $stackapp_affiliate->getIsActive())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $stackapp_affiliate->getEmail() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_token">
  <?php echo $stackapp_affiliate->getToken() ?>
</td>
