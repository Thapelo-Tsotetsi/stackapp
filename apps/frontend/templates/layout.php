<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
<title>
  <?php if (!include_slot('title')): ?>
    Stackapp - Your best job board
  <?php endif; ?>
</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
			<h1>
			  <a href="<?php echo url_for('@homepage') ?>">
			    <img src="/images/sy" alt="Stackapp Job Board" />
			  </a>
			</h1>
 
          <div id="sub_header">
            <div class="search">
            <h2>Ask for a job</h2>
            <form action="<?php echo url_for('@job_search') ?>" method="get">
              <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
              <input type="submit" value="search" />
              <div class="help">
                Enter some keywords (city, country, position, ...)
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
 
      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif; ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif; ?>
 

<div id="job_history">
  Recent viewed jobs:
  <ul>
    <?php foreach ($sf_user->getJobHistory() as $job): ?>
      <li>
        <?php echo link_to($job->getPosition().' - '.$job->getCompany(), 'job_show_user', $job) ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>
 
      <div id="footer">
        <div class="content">
          <span class="symfony">
            <img src="/images/stackapp-mini.png" />
            powered by <a href="/">
            <img src="/images/symfony.gif" alt="symfony framework" />
            </a>
          </span>
          <ul>
            <li><a href="/about.html">About Stackapp</a></li>
            <li class="last"><a href="<?php echo url_for('@update_new') ?>">Receive Updates</a></li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>