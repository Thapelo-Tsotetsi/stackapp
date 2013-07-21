<?php
class StackappCleanupTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod'),
      new sfCommandOption('days', null, sfCommandOption::PARAMETER_REQUIRED, '', 90),
    ));
 
    $this->namespace = 'stackapp';
    $this->name = 'cleanup';
    $this->briefDescription = 'Cleanup stackapp database';
 
    $this->detailedDescription = <<<EOF
The [stackapp:cleanup|INFO] task cleans up the Stackapp database:
 
  [./symfony stackapp:cleanup --env=prod --days=90|INFO]
EOF;
  }
 
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
   
    // cleanup Lucene index
    $index = Doctrine::getTable('StackappJob')->getLuceneIndex();
   
    $q = Doctrine_Query::create()
      ->from('StackappJob j')
      ->where('j.expires_at < ?', date('Y-m-d'));
   
    $jobs = $q->execute();
    foreach ($jobs as $job)
    {
      if ($hit = $index->find('pk:'.$job->getId()))
      {
        $index->delete($hit->id);
      }
    }
   
    $index->optimize();
   
    $this->logSection('lucene', 'Cleaned up and optimized the job index');
   
    // Remove stale jobs
    $nb = Doctrine::getTable('StackappJob')->cleanup($options['days']);
   
    $this->logSection('doctrine', sprintf('Removed %d stale jobs', $nb));
  }
}