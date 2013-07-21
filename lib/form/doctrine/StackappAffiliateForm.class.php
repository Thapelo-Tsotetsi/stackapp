<?php

/**
 * StackappAffiliate form.
 *
 * @package    form
 * @subpackage StackappAffiliate
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class StackappAffiliateForm extends BaseStackappAffiliateForm
{
  public function configure()
  {
    unset($this['is_active'], $this['token'], $this['created_at'], $this['updated_at']);
 
    $this->widgetSchema['stackapp_categories_list']->setOption('expanded', true);
    $this->widgetSchema['stackapp_categories_list']->setLabel('Categories');
 
    $this->validatorSchema['stackapp_categories_list']->setOption('required', true);
 
    $this->widgetSchema['email']->setAttribute('size', 50);
 
    $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));
  }
}