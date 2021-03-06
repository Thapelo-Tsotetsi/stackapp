<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * StackappAffiliate filter form base class.
 *
 * @package    filters
 * @subpackage StackappAffiliate *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseStackappAffiliateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'email'                    => new sfWidgetFormFilterInput(),
      'token'                    => new sfWidgetFormFilterInput(),
      'is_active'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'stackapp_categories_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'StackappCategory')),
    ));

    $this->setValidators(array(
      'email'                    => new sfValidatorPass(array('required' => false)),
      'token'                    => new sfValidatorPass(array('required' => false)),
      'is_active'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'stackapp_categories_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'StackappCategory', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stackapp_affiliate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addStackappCategoriesListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('StackappCategoryAffiliate.category_id', $values);
  }

  public function getModelName()
  {
    return 'StackappAffiliate';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'email'                    => 'Text',
      'token'                    => 'Text',
      'is_active'                => 'Boolean',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'stackapp_categories_list' => 'ManyKey',
    );
  }
}