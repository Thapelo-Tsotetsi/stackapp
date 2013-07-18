<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * StackappCategory filter form base class.
 *
 * @package    filters
 * @subpackage StackappCategory *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseStackappCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                     => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'slug'                     => new sfWidgetFormFilterInput(),
      'stackapp_affiliates_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'StackappAffiliate')),
    ));

    $this->setValidators(array(
      'name'                     => new sfValidatorPass(array('required' => false)),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'slug'                     => new sfValidatorPass(array('required' => false)),
      'stackapp_affiliates_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'StackappAffiliate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stackapp_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addStackappAffiliatesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.StackappCategoryAffiliate StackappCategoryAffiliate')
          ->andWhereIn('StackappCategoryAffiliate.affiliate_id', $values);
  }

  public function getModelName()
  {
    return 'StackappCategory';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'name'                     => 'Text',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'slug'                     => 'Text',
      'stackapp_affiliates_list' => 'ManyKey',
    );
  }
}