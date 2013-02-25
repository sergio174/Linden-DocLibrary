<div class="docs index well">
	
	


	<div class="mainActions btn-group">
		<?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Upload new doc'), 
										array('action' => 'add'), 
										array('class' => 'btn btn-primary modalink fancybox.ajax',
											  'escape' => false)
										); ?>


			
	</div>


	<?php echo str_replace('class="message"', 'class="message alert alert-info"', $this->Session->flash() ) ?>

	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
	<tr>
			<th>#</th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th>Last version notes</th>
			
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th>Last update</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
	$i=0;
	foreach ($docs as $doc): 
	
	?>
	<tr>
		<td><?php echo $i+1 ?>&nbsp;</td>
		<td><?php echo h($doc['Doc']['name']); ?>&nbsp;</td>
		<td><?php echo h($doc['Doc']['description']); ?>&nbsp;</td>
		<td><?php echo h($doc['Docversion'][0]['notes']); ?>&nbsp;</td>
		<td><?php echo h($doc['Doc']['created']); ?>&nbsp;</td>
		<td><?php echo h($doc['Docversion'][0]['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> New version'), 
										array('controller' => 'docversions', 'action' => 'add', $doc['Doc']['id']), 
										array('class' => 'btn btn-mini btn-primary modalink fancybox.ajax',
											  'escape' => false)
										); ?></li>
			<?php echo $this->Html->link(__('<i class="icon-download icon-white"></i> Download'), array( 'action' => 'download', $doc['Doc']['id']), array('escape'=>false,'class' => 'btn btn-mini btn-success')); ?>
			<?php echo $this->Html->link(__('<i class="icon-time icon-white"></i> View history'), array('action' => 'view', $doc['Doc']['id']), array('escape'=>false,'class' => 'btn btn-mini btn-info modalink fancybox.ajax')); ?>
			<?php echo $this->Html->link(__('<i class="icon-pencil icon-white"></i> Edit'), array('action' => 'edit', $doc['Doc']['id']), array('escape'=>false, 'class' => 'btn btn-mini btn-warning modalink fancybox.ajax')); ?>
			<?php echo $this->Form->postLink(__('<i class="icon-trash icon-white"></i> Delete'), array('action' => 'delete', $doc['Doc']['id']), array('escape'=>false,'class' => 'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $doc['Doc']['id'])); ?>
		</td>
	</tr>
<?php $i++; endforeach; ?>
	</table>
	

	<p class="text-info">
		<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
		?>
	</p>
	<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>



