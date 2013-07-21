<?php

/**
 * update module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage update
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class BaseUpdateGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getCredentials($action)
  {
    if (0 === strpos($action, '_'))
    {
      $action = substr($action, 1);
    }

    return isset($this->configuration['credentials'][$action]) ? $this->configuration['credentials'][$action] : array();
  }

  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  'activate' => NULL,  'deactivate' => NULL,);
  }

  public function getListActions()
  {
    return array();
  }

  public function getListBatchActions()
  {
    return array(  'activate' => NULL,  'deactivate' => NULL,);
  }

  public function getListParams()
  {
    return '%%is_active%% - %%email%% - %%token%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Updates Management';
  }

  public function getEditTitle()
  {
    return 'Edit Update';
  }

  public function getNewTitle()
  {
    return 'New Update';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'email',  1 => 'is_active',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'is_active',  1 => 'email',  2 => 'token',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'token' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_active' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Active?',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'stackapp_categories_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'stackapp_categories_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'stackapp_categories_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'stackapp_categories_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'stackapp_categories_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'email' => array(),
      'token' => array(),
      'is_active' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'stackapp_categories_list' => array(),
    );
  }


  /**
   * Gets a new form object.
   *
   * @param  mixed $object
   *
   * @return sfForm
   */
  public function getForm($object = null)
  {
    $class = $this->getFormClass();

    return new $class($object, $this->getFormOptions());
  }

  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'StackappAffiliateForm';
  }

  public function getFormOptions()
  {
    return array();
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'StackappAffiliateFormFilter';
  }

  public function getFilterForm($filters)
  {
    $class = $this->getFilterFormClass();

    return new $class($filters, $this->getFilterFormOptions());
  }

  public function getFilterFormOptions()
  {
    return array();
  }

  public function getFilterDefaults()
  {
    return array();
  }

  public function getPager($model)
  {
    $class = $this->getPagerClass();

    return new $class($model, $this->getPagerMaxPerPage());
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array('is_active', 'asc');
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }

  public function getConnection()
  {
    return null;
  }
}
