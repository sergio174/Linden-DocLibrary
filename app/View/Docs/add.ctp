<div class="docs form">
<h2><?php echo __('Upload new document to the library'); ?></h2>
<?php echo $this->Form->create('Doc', array('type' => 'file', 'class'=>'form-horizontal ')); ?>
	<fieldset>
		
	<?php
		echo $this->Form->input('name', array(	'div'=>array('class' => 'control-group'),
												'label'=>array('class' =>'control-label'),
												'between' => '<div class="controls">',
												'after' => '</div>')
											);

		echo $this->Form->input('Docversion.0.file', array(	'type'=>'file',
															'div'=>array('class' => 'control-group'),
															'label'=>array('class' =>'control-label'),
															'between' => '<div class="controls">',
															'after' => '</div>')
													);
		
		echo $this->Form->input('description', array(	'div'=>array('class' => 'control-group'),
												'label'=>array('class' =>'control-label'),
												'between' => '<div class="controls">',
												'after' => '</div>')
											);
		// echo $this->Form->input('current_docversion');
	
		
		echo $this->Form->input('Docversion.0.notes', array('value' => 'V1',
															'type' => 'hidden'));
		echo $this->Form->input('Docversion.0.is_current', array('value' => '1',
															'type' => 'hidden'));
	?>

	</fieldset>
	
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button( "<i class='icon-ok icon-white'></i> Upload it!",
										array(	'class'   => 'btn btn-primary',
												
												'escape' => false,				
												// 'type' => 'submit'		
												
												)
									); ?>


		</div>
	</div>	

<?php echo $this->Form->end(); ?>
	
</div>
