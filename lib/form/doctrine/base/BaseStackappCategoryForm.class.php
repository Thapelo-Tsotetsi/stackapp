<?php

/**
 * StackappCategory form base class.
 *
 * @package    form
 * @subpackage stackapp_category
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseStackappCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'name'                     => new sfWidgetFormInput(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'slug'                     => new sfWidgetFormInput(),
      'stackapp_affiliates_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'StackappAffiliate')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorDoctrineChoice(array('model' => 'StackappCategory', 'column' => 'id', 'required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 255)),
      'created_at'               => new sfValidatorDateTime(array('required' => false)),
      'updated_at'               => new sfValidatorDateTime(array('required' => false)),
      'slug'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'stackapp_affiliates_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'StackappAffiliate', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'StackappCategory', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('stackapp_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StackappCategory';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['stackapp_affiliates_list']))
    {
      $this->setDefault('stackapp_affiliates_list', $this->object->StackappAffiliates->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveStackappAffiliatesList($con);
  }

  public function saveStackappAffiliatesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['stackapp_affiliates_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->StackappAffiliates->getPrimaryKeys();
    $values = $this->getValue('stackapp_affiliates_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('StackappAffiliates', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('StackappAffiliates', array_values($link));
    }
  }

}
