<?php

/**
 * StackappCategory form.
 *
 * @package    form
 * @subpackage StackappCategory
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class StackappCategoryForm extends BaseStackappCategoryForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['stackapp_affiliates_list']);
  }
}