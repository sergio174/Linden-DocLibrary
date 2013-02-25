

<div class="related">
	<h3><?php echo $doc['Doc']['name'] ?></h3>
	<h4>Document history</h4>
	
	<div class="mainActions btn-group">
		<?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Upload new doc version'), 
										array('controller' => 'docversions', 'action' => 'add', $doc['Doc']['id']), 
										array('class' => 'btn btn-primary modalink fancybox.ajax',
											  'escape' => false)
										); ?></li>
			
	</div>

	

	
	
	<table cellpadding = "0" cellspacing = "0" class="table table-bordered table-striped">
	<tr>
		<th><?php echo __('#'); ?></th>
		<th><?php echo __('Notes'); ?></th>
		<th><?php echo __('Date'); ?></th>
		
		<th class="actions" width="205"></th>
	</tr>
	<?php
		$i = 0;
		foreach ($doc['Docversion'] as $docversion): ?>
		<tr>
			<td><?php echo $i+1; ?></td>
			<td><?php echo $docversion['notes']; ?></td>
			<td><?php echo $docversion['created']; ?></td>
			
			<td class="actions">
				
				<?php echo $this->Html->link(__('<i class="icon-download icon-white"></i> '), array('controller'=>'docversions', 'action' => 'download', $docversion['id']), array('escape'=>false,'class' => 'btn btn-mini btn-success')); ?>
				


				<?php echo $this->Html->link(__('<i class="icon-pencil icon-white"></i> '), array('controller'=>'docversions', 'action' => 'edit', $docversion['id']), array('escape'=>false, 'class' => 'btn btn-mini btn-warning modalink fancybox.ajax')); ?>

				
				<?php echo $this->Form->postLink(__('<i class="icon-trash icon-white"></i> '), array('controller'=>'docversions', 'action' => 'delete', $docversion['id']), array('escape'=>false,'class' => 'btn btn-mini btn-danger'), __('Are you sure you want to delete this file?', $doc['Doc']['id'])); ?>

				<?php echo $i==0 ? '<button class="btn btn-mini disabled">Current version</button>' : 
						$this->Form->postLink(__('<i class="icon-refresh icon-white"></i> Restore'), array('controller'=>'docversions', 'action' => 'setAsCurrent', $docversion['id']), array('escape'=>false,'class' => 'btn btn-mini btn-info'), __('Are you sure you want to restore this file version?', $doc['Doc']['id'])); ?>

				
			</td>
		</tr>
	<?php $i++; endforeach; ?>
	</table>


	
</div>
