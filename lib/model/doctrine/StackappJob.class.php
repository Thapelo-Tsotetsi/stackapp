<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class StackappJob extends BaseStackappJob
{
	public function getCompanySlug()
	{
	  return Stackapp::slugify($this->getCompany());
	}
	 
	public function getPositionSlug()
	{
	  return Stackapp::slugify($this->getPosition());
	}
	 
	public function getLocationSlug()
	{
	  return Stackapp::slugify($this->getLocation());
	}

	public function save(Doctrine_Connection $conn = null)
	{
	  if ($this->isNew() && !$this->getExpiresAt())
	  {
	    $now = $this->getCreatedAt() ? strtotime($this->getCreatedAt()) : time();
	    $this->setExpiresAt(date('Y-m-d H:i:s', $now + 86400 * sfConfig::get('app_active_days')));
	  }
	 
	   if (!$this->getToken())
	  {
	    $this->setToken(sha1($this->getEmail().rand(11111, 99999)));
	  }

	  $conn = $conn ? $conn : $this->getTable()->getConnection();
	  $conn->beginTransaction();
	  try
	  {
	    $ret = parent::save($conn);
	 
	    $this->updateLuceneIndex();
	 
	    $conn->commit();
	 
	    return $ret;
	  }
	  catch (Exception $e)
	  {
	    $conn->rollBack();
	    throw $e;
	  }
	}

	  public function extend($force = false)
	  {
	    if (!$force && !$this->expiresSoon())
	    {
	      return false;
	    }
	 
	    $this->setExpiresAt(date('Y-m-d', time() + 86400 * sfConfig::get('app_active_days')));
	    $this->save();
	 
	    return true;
	  }

	public function getTypeName()
	{
	  $types = Doctrine::getTable('StackappJob')->getTypes();
	  return $this->getType() ? $types[$this->getType()] : '';
	}
	 
	public function isExpired()
	{
	  return $this->getDaysBeforeExpires() < 0;
	}
	 
	public function expiresSoon()
	{
	  return $this->getDaysBeforeExpires() < 5;
	}
	 
	public function getDaysBeforeExpires()
	{
	  return floor((strtotime($this->getExpiresAt()) - time()) / 86400);
	}

	public function publish()
	{
	  $this->setIsActivated(true);
	  $this->save();
	}

	public function updateLuceneIndex()
	{
	  $index = $this->getTable()->getLuceneIndex();
	 
	  // remove existing entries
	  foreach ($index->find('pk:'.$this->getId()) as $hit)
	  {
	    $index->delete($hit->id);
	  }
	 
	  // don't index expired and non-activated jobs
	  if ($this->isExpired() || !$this->getIsActivated())
	  {
	    return;
	  }
	 
	  $doc = new Zend_Search_Lucene_Document();
	 
	  // store job primary key to identify it in the search results
	  $doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
	 
	  // index job fields
	  $doc->addField(Zend_Search_Lucene_Field::UnStored('position', $this->getPosition(), 'utf-8'));
	  $doc->addField(Zend_Search_Lucene_Field::UnStored('company', $this->getCompany(), 'utf-8'));
	  $doc->addField(Zend_Search_Lucene_Field::UnStored('location', $this->getLocation(), 'utf-8'));
	  $doc->addField(Zend_Search_Lucene_Field::UnStored('description', $this->getDescription(), 'utf-8'));
	 
	  // add job to the index
	  $index->addDocument($doc);
	  $index->commit();
	}

	public function delete(Doctrine_Connection $conn = null)
	{
	  $index = $this->getTable()->getLuceneIndex();
	 
	  foreach ($index->find('pk:'.$this->getId()) as $hit)
	  {
	    $index->delete($hit->id);
	  }
	 
	  return parent::delete($conn);
	}
}