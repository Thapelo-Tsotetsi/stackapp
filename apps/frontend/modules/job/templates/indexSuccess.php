<h1>Job List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Category</th>
      <th>Type</th>
      <th>Company</th>
      <th>Logo</th>
      <th>Url</th>
      <th>Position</th>
      <th>Location</th>
      <th>Description</th>
      <th>Requirements one</th>
      <th>Requirements two</th>
      <th>Requirements three</th>
      <th>How to apply</th>
      <th>Token</th>
      <th>Is public</th>
      <th>Is activated</th>
      <th>Email</th>
      <th>Expires at</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stackapp_job_list as $stackapp_job): ?>
    <tr>
      <td><a href="<?php echo url_for('job/show?id='.$stackapp_job->getId()) ?>"><?php echo $stackapp_job->getId() ?></a></td>
      <td><?php echo $stackapp_job->getCategoryId() ?></td>
      <td><?php echo $stackapp_job->getType() ?></td>
      <td><?php echo $stackapp_job->getCompany() ?></td>
      <td><?php echo $stackapp_job->getLogo() ?></td>
      <td><?php echo $stackapp_job->getUrl() ?></td>
      <td><?php echo $stackapp_job->getPosition() ?></td>
      <td><?php echo $stackapp_job->getLocation() ?></td>
      <td><?php echo $stackapp_job->getDescription() ?></td>
      <td><?php echo $stackapp_job->getRequirementsOne() ?></td>
      <td><?php echo $stackapp_job->getRequirementsTwo() ?></td>
      <td><?php echo $stackapp_job->getRequirementsThree() ?></td>
      <td><?php echo $stackapp_job->getHowToApply() ?></td>
      <td><?php echo $stackapp_job->getToken() ?></td>
      <td><?php echo $stackapp_job->getIsPublic() ?></td>
      <td><?php echo $stackapp_job->getIsActivated() ?></td>
      <td><?php echo $stackapp_job->getEmail() ?></td>
      <td><?php echo $stackapp_job->getExpiresAt() ?></td>
      <td><?php echo $stackapp_job->getCreatedAt() ?></td>
      <td><?php echo $stackapp_job->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('job/new') ?>">New</a>
