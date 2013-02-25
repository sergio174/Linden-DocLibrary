<div class="docversions view">
<h2><?php  echo __('Docversion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($docversion['Docversion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doc'); ?></dt>
		<dd>
			<?php echo $this->Html->link($docversion['Doc']['name'], array('controller' => 'docs', 'action' => 'view', $docversion['Doc']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($docversion['Docversion']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($docversion['Docversion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($docversion['Docversion']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Docversion'), array('action' => 'edit', $docversion['Docversion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Docversion'), array('action' => 'delete', $docversion['Docversion']['id']), null, __('Are you sure you want to delete # %s?', $docversion['Docversion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Docversions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docversion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Docs'), array('controller' => 'docs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doc'), array('controller' => 'docs', 'action' => 'add')); ?> </li>
	</ul>
</div>
