<?php

require_once dirname(__FILE__).'/../lib/updateGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/updateGeneratorHelper.class.php';

/**
 * update actions.
 *
 * @package    stackapp
 * @subpackage update
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class updateActions extends autoUpdateActions
{
	public function executeListActivate()
	  {
	    $affiliate = $this->getRoute()->getObject();
	    $affiliate->activate();
	 
	    // send an email to the affiliate
	    ProjectConfiguration::registerZend();
	    $mail = new Zend_Mail();
	    $mail->setBodyText(<<<EOF
Your Stackapp app subscription has been activated.
	 
Stay tuned.
	 
The Stackapp Bot.
EOF
);
	    $mail->setFrom('thapelo.tsotetsi504@gmail.com', 'Stackapp Bot');
	    $mail->addTo($affiliate->getEmail());
	    $mail->setSubject('Stackapp subscription');
	    $mail->send();
	 
	    $this->redirect('@stackapp_affiliate_update');
	  }
 
  public function executeListDeactivate()
  {
    $this->getRoute()->getObject()->deactivate();
 
    $this->redirect('@stackapp_affiliate_update');
  }
 
  public function executeBatchActivate(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()
      ->from('StackappAffiliate a')
      ->whereIn('a.id', $request->getParameter('ids'));
 
    $affiliates = $q->execute();
 
    foreach ($affiliates as $affiliate)
    {
      $affiliate->activate();
    }
 
    $this->redirect('@stackapp_affiliate_update');
  }
 
  public function executeBatchDeactivate(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()
      ->from('StackappAffiliate a')
      ->whereIn('a.id', $request->getParameter('ids'));
 
    $affiliates = $q->execute();
 
    foreach ($affiliates as $affiliate)
    {
      $affiliate->deactivate();
    }
 
    $this->redirect('@stackapp_affiliate_update');
  }
}
