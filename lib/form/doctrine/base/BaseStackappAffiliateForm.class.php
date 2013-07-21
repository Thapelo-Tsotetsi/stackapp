<?php

/**
 * StackappAffiliate form base class.
 *
 * @package    form
 * @subpackage stackapp_affiliate
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseStackappAffiliateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'email'                    => new sfWidgetFormInput(),
      'token'                    => new sfWidgetFormInput(),
      'is_active'                => new sfWidgetFormInputCheckbox(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'stackapp_categories_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'StackappCategory')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorDoctrineChoice(array('model' => 'StackappAffiliate', 'column' => 'id', 'required' => false)),
      'email'                    => new sfValidatorString(array('max_length' => 255)),
      'token'                    => new sfValidatorString(array('max_length' => 255)),
      'is_active'                => new sfValidatorBoolean(),
      'created_at'               => new sfValidatorDateTime(array('required' => false)),
      'updated_at'               => new sfValidatorDateTime(array('required' => false)),
      'stackapp_categories_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'StackappCategory', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'StackappAffiliate', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('stackapp_affiliate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StackappAffiliate';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['stackapp_categories_list']))
    {
      $this->setDefault('stackapp_categories_list', $this->object->StackappCategories->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveStackappCategoriesList($con);
  }

  public function saveStackappCategoriesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['stackapp_categories_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->StackappCategories->getPrimaryKeys();
    $values = $this->getValue('stackapp_categories_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('StackappCategories', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('StackappCategories', array_values($link));
    }
  }

}
