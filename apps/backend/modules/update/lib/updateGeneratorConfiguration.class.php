<?php

/**
 * update module configuration.
 *
 * @package    stackapp
 * @subpackage update
 * @author     Thapelo Tsotetsi
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class updateGeneratorConfiguration extends BaseUpdateGeneratorConfiguration
{
	 public function getFilterDefaults()
  {
    return array('is_active' => '0');
  }
}
