<div class="docs form">
<?php echo $this->Form->create('Doc', array('class'=>'form-horizontal ')); ?>
	<fieldset>
		<legend><?php echo __('Edit Doc info'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array(	'div'=>array('class' => 'control-group'),
												'label'=>array('class' =>'control-label'),
												'between' => '<div class="controls">',
												'after' => '</div>')
											);
		// echo $this->Form->input('description');
		// echo $this->Form->input('current_docversion');

		echo $this->Form->input('description', array(	'div'=>array('class' => 'control-group'),
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