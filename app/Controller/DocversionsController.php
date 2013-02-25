<?php
App::uses('AppController', 'Controller');
/**
 * Docversions Controller
 *
 * @property Docversion $Docversion
 */
class DocversionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Docversion->recursive = 0;

		$this->paginate= array('order' => array('Docversion.is_current' => 'DESC', 'Docversion.created' => 'DESC'));

		$this->set('docversions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Docversion->exists($id)) {
			throw new NotFoundException(__('Invalid docversion'));
		}
		$options = array('conditions' => array('Docversion.' . $this->Docversion->primaryKey => $id));
		$this->set('docversion', $this->Docversion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($docid = null) {

		$this->layout="ajax";


		if ($this->request->is('post')) {
			$this->Docversion->create();
			

			$dataSource = $this->Docversion->getDataSource();
			$dataSource->begin();
			
				
				$relatedTo_NoCurrent = $this->Docversion->updateAll(
				    array('Docversion.is_current' => '0'),
				    array('Docversion.doc_id' => $this->request->data['Docversion']['doc_id'])
				);
				
				$savedDocversion = $this->Docversion->save($this->request->data);


			if ($relatedTo_NoCurrent && $savedDocversion) {

				$dataSource->commit();

				$this->Session->setFlash(__('The docversion has been saved'));
				$this->redirect(array('controller'=> 'docs', 'action' => 'index'));
			} else {
				$dataSource->rollback();

				$this->Session->setFlash(__('The docversion could not be saved. Please, try again.'));
			}
		}
		
		$doc = $this->Docversion->Doc->findById($docid);
		
		$this->set(compact('doc'));
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

		if (!$this->Docversion->exists($id)) {
			throw new NotFoundException(__('Invalid docversion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Docversion->save($this->request->data)) {
				$this->Session->setFlash(__('The docversion has been saved'));
				$this->redirect(array('controller'=> 'docs', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docversion could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Docversion.' . $this->Docversion->primaryKey => $id));
			$docversion = $this->request->data = $this->Docversion->find('first', $options);
		}
		
		$this->set(compact('docversion'));
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
		$this->Docversion->id = $id;
		if (!$this->Docversion->exists()) {
			throw new NotFoundException(__('Invalid docversion'));
		}
		$this->request->onlyAllow('post', 'delete');
		
		$this->Docversion->read();

		// Begin transaction
		$dataSource = $this->Docversion->getDataSource();
		$dataSource->begin();

		// Set a variable to check if deletion was successful
		$deleted = $this->Docversion->delete();

		// Check if is there any other file version for the file, and takes the newest
		$theNewCurrent = $this->Docversion->find('first', array('conditions' => array('Docversion.doc_id' => $this->Docversion->data['Docversion']['doc_id']),
																'order' => array('Docversion.created' => 'DESC')
																)
												);
		// Default 
		$savedDocversion = true;

		//If other version exists
		if($theNewCurrent)
		{
			// Tasks for make it the new current version

			$this->Docversion->create();
			$this->Docversion->id = $theNewCurrent['Docversion']['id'];

			$savedDocversion = $this->Docversion->saveField('is_current', 1);
		}
		
		// If deletion successfull and savedDocVersion didnt exist or was actually updated
		// Save the transaction
		if($deleted && $savedDocversion)
		{
			$dataSource->commit();

			$this->Session->setFlash(__('File version deleted'));
			$this->redirect(array('controller' =>'docs', 'action' => 'index'));
		}
		else
		{
			$dataSource->rollback();
		}
		$this->Session->setFlash(__('File version was not deleted'));
		$this->redirect(array('controller' =>'docs', 'action' => 'index'));
	}

	public function setAsCurrent($id = null) {
		$this->Docversion->id = $id;
		if (!$this->Docversion->exists()) {
			throw new NotFoundException(__('Invalid docversion'));
		}
		
		$this->Docversion->read();

		// pr($this->Docversion->data);

		$dataSource = $this->Docversion->getDataSource();
		$dataSource->begin();
			
				
				$relatedTo_NoCurrent = $this->Docversion->updateAll(
				    array('Docversion.is_current' => '0'),
				    array('Docversion.doc_id' => $this->Docversion->data['Docversion']['doc_id'])
				);
				
				// pr($this->Docversion->data);

				$savedDocversion = $this->Docversion->saveField('is_current', 1);


		if ($relatedTo_NoCurrent && $savedDocversion) {

			$dataSource->commit();
			$this->Session->setFlash(__('Docversion restored'));
			$this->redirect(array('controller' =>'docs', 'action' => 'index'));
		}
		else
			$dataSource->rollback();

		$this->Session->setFlash(__('Docversion was not deleted'));
		$this->redirect(array('action' => 'index'));
	}




	public function download($id= null)
	{
		$this->autorender = false;
		$this->Docversion->id = $id;
		$this->Docversion->read();

		$path = APP . '_userfiles' . DS .'files/docversion/file/' . $this->Docversion->data['Docversion']['id']. DS;
		$filename = $this->Docversion->data['Docversion']['file'];

		$mime = mime_content_type($path.$filename);
		$extension = pathinfo($path.$filename, PATHINFO_EXTENSION);
		$downloadName = $this->Docversion->data['Doc']['name'].'_'.$this->Docversion->data['Docversion']['created'];

		$this->view = 'Media';
        $params = array(
              'id' => $filename,
              'name' =>$downloadName ,
              'download' => true,
              'extension' => $extension,  
              'path' => $path ,
              'mimeType'=> $mime
       );

       header('Content-type: '.$mime);
	   header('Content-Disposition: attachment; filename="'.$downloadName.'.'.$extension.'"');
	   readfile($file);


	}

	
}
