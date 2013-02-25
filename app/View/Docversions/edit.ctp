<div class="docversions form">
<?php echo $this->Form->create('Docversion', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?php echo $docversion['Doc']['name'] ?></legend>
		<h5> <?php echo __('Edit version: '). $docversion['Docversion']['created']; ?> </h5>
	<?php
		echo $this->Form->input('id');
		// echo $this->Form->input('doc_id');
		echo $this->Form->input('notes', array(	'div'=>array('class' => 'control-group'),
												'label'=>array('class' =>'control-label'),
												'between' => '<div class="controls">',
												'after' => '</div>')
											);
	?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button( "<i class='icon-ok icon-white'></i> OK, save changes!",
										array(	'class'   => 'btn btn-primary',
												
												'escape' => false,				
												// 'type' => 'submit'		
												
												)
									); ?>


		</div>
	</div>	

<?php echo $this->Form->end(); ?>
</div>