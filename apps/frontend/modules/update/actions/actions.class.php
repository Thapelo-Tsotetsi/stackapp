<?php

/**
 * update actions.
 *
 * @package    stackapp
 * @subpackage update
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class updateActions extends sfActions
{

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new StackappAffiliateForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new StackappAffiliateForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $stackapp_affiliate = $form->save();

      //$this->redirect('update/edit?id='.$stackapp_affiliate->getId());
      $this->redirect($this->generateUrl('update_wait', $stackapp_affiliate));
    }
  }

  public function executeWait()
  {
  }
}
