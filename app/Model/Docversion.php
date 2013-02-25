<?php
App::uses('AppModel', 'Model');
/**
 * Docversion Model
 *
 * @property Doc $Doc
 */
class Docversion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'notes';


/**
 * File upload
 *
 * @var array
 */
	public $actsAs = array(
        'Upload.Upload' => array(
            'file' => array(
                'fields' => array(
                    'dir' => 'id'
                ),
                'path' => '{ROOT}_userfiles{DS}files{DS}{model}{DS}{field}{DS}'
            )
        )
    );



/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'doc_id' => array(
			'naturalnumber' => array(
				'rule' => array('naturalnumber'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'notes' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Doc' => array(
			'className' => 'Doc',
			'foreignKey' => 'doc_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
