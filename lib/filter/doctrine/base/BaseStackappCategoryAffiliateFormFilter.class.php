<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * StackappCategoryAffiliate filter form base class.
 *
 * @package    filters
 * @subpackage StackappCategoryAffiliate *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseStackappCategoryAffiliateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('stackapp_category_affiliate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StackappCategoryAffiliate';
  }

  public function getFields()
  {
    return array(
      'category_id'  => 'Number',
      'affiliate_id' => 'Number',
    );
  }
}