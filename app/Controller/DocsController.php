<?php
App::uses('AppController', 'Controller');
/**
 * Docs Controller
 *
 * @property Doc $Doc
 */
class DocsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Doc->recursive = 1;

		$this->Doc->bindModel(array(
            'hasMany' => array(
            'Docversion' => array(
                'conditions' =>array('Docversion.is_current' => '1'))
            )
        ));

		$this->set('docs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout="ajax";

		if (!$this->Doc->exists($id)) {
			throw new NotFoundException(__('Invalid doc'));
		}
		$options = array('conditions' => array('Doc.' . $this->Doc->primaryKey => $id),
						// 'order' => array('Docversion.is_current' => 'DESC', 'Docversion.created' => 'DESC'),
						);

		
		$this->set('doc', $this->Doc->find('first', $options));

		// pr($this->Doc->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout="ajax";

		if ($this->request->is('post')) {
			$this->Doc->create();

			// pr($this->request->data);
			// $goingWell = true;

			// $dataSource = $this->Doc->getDataSource();
			// $dataSource->begin();

			if( $this->Doc->saveAll( $this->request->data ) )
			{

				// $docAndVersionSaved = ;

				// $this->Doc->id = $this->Doc->getLastInsertID();
				
				// $lastVersionSaved = $this->Doc->saveField('current_docversion', $this->Doc->Docversion->getLastInsertID());

				
			
				// $dataSource->commit();

				$this->Session->setFlash(__('The doc has been saved'));
				$this->redirect(array('action' => 'index'));
			}
			else 
			{
				$this->Session->setFlash(__('The doc could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout="ajax";

		if (!$this->Doc->exists($id)) {
			throw new NotFoundException(__('Invalid doc'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Doc->save($this->request->data)) {
				$this->Session->setFlash(__('The doc has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The doc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Doc.' . $this->Doc->primaryKey => $id));
			$this->request->data = $this->Doc->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Doc->id = $id;
		if (!$this->Doc->exists()) {
			throw new NotFoundException(__('Invalid doc'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Doc->delete($id = $this->Doc->id, $cascade = true)) {
			$this->Session->setFlash(__('Doc deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Doc was not deleted'));
		$this->redirect(array('action' => 'index'));
	}



	function download($id= null)
	{
		// $this->Doc->Docversion->recursive = -1;
		$docVersionId = $this->Doc->Docversion->field('id',	array(  'Docversion.is_current' => 1,
																	'Docversion.doc_id' => $id
																	)
														);

		// pr($docVersionId);

		$this->redirect(array('controller'=>'Docversions', 'action' =>'download', $docVersionId ));
		

	}
}
