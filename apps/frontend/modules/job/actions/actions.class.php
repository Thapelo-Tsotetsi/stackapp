<?php

/**
 * job actions.
 *
 * @package    stackapp
 * @subpackage job
 * @author     Thapelo Tsotetsi
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->categories = Doctrine::getTable('StackappCategory')->getWithJobs();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->job = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $job = new StackappJob();
    $job->setType('full-time');
   
    $this->form = new StackappJobForm($job);
  }
   
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new StackappJobForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }
   
  public function executeEdit(sfWebRequest $request)
  {
    $this->form = new StackappJobForm($this->getRoute()->getObject());
  }
   
  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new StackappJobForm($this->getRoute()->getObject());
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }
   
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
   
    $job = $this->getRoute()->getObject();
    $job->delete();
   
    $this->redirect('job/index');
  }
   
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );
   
    if ($form->isValid())
    {
      $job = $form->save();
   
      $this->redirect($this->generateUrl('job_show', $job));
    }
  }

  public function executePublish(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
   
    $job = $this->getRoute()->getObject();
    $job->publish();
   
    $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));
   
    $this->redirect($this->generateUrl('job_show_user', $job));
  }
}
