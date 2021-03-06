<?php

/**
 * StackappJob form.
 *
 * @package    form
 * @subpackage StackappJob
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class StackappJobForm extends BaseStackappJobForm
{
  public function configure()
  {
    $this->removeFields();
 
    $this->validatorSchema['email'] = new sfValidatorAnd(array(
      $this->validatorSchema['email'],
      new sfValidatorEmail(),
    ));
 
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine::getTable('StackappJob')->getTypes(),
      'expanded' => true,
    ));
    $this->validatorSchema['type'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine::getTable('StackappJob')->getTypes()),
    ));
 
    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Company logo',
    ));
 
    $this->widgetSchema->setLabels(array(
      'category_id'    => 'Category',
      'is_public'      => 'Public?',
      'how_to_apply'   => 'How to apply?',
    ));
 
    $this->validatorSchema['logo'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/jobs',
      'mime_types' => 'web_images',
    ));
 
    $this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');
  }

    protected function removeFields()
  {
    unset(
      $this['created_at'], $this['updated_at'],
      $this['expires_at'], $this['is_activated'],
      $this['token']
    );
  }
}