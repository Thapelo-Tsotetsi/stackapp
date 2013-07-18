<?php

/**
 * category actions.
 *
 * @package    stackapp
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class categoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeShow(sfWebRequest $request)
	{
	  $this->category = $this->getRoute()->getObject();
	 
	  $this->pager = new sfDoctrinePager(
	    'StackappJob',
	    sfConfig::get('app_max_jobs_on_category')
	  );
	  $this->pager->setQuery($this->category->getActiveJobsQuery());
	  $this->pager->setPage($request->getParameter('page', 1));
	  $this->pager->init();
	}
}
