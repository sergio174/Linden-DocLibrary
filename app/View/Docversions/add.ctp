<div class="docversions form">
<?php echo $this->Form->create('Docversion', array('type' => 'file', 'class'=>'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo $doc['Doc']['name']; ?></legend>

		<h5><?php echo __('Upload new doc version'); ?></h5>
	<?php
		
		echo $this->Form->hidden('doc_id', array('value' =>$doc['Doc']['id']));
		
		echo $this->Form->input('file', array(	'type'=>'file',
															'div'=>array('class' => 'control-group'),
															'label'=>array('class' =>'control-label'),
															'between' => '<div class="controls">',
															'after' => '</div>')
													);

		echo $this->Form->input('notes', array(	'div'=>array('class' => 'control-group'),
												'label'=>array('class' =>'control-label'),
												'between' => '<div class="controls">',
												'after' => '</div>')
											);
	?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button( "<i class='icon-ok icon-white'></i> Upload new version!",
										array(	'class'   => 'btn btn-primary',
												
												'escape' => false,				
												// 'type' => 'submit'		
												
												)
									); ?>


		</div>
	</div>
</div>