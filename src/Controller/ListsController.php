<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

Class ListsController extends AppController{

public function initialize(): void
    {
        parent::initialize();
        $this->todolists = TableRegistry::getTableLocator()->get('lists');
    }
public function index(){
    
    $todolists = $this->todolists->find();
    $this->set(compact('todolists'));
    if ($this->request->is('post')){
        $getName = $this ->request ->getData('body');
        $button = $this->request->getData('btnT');
        $entity = $this->todolists->newEmptyEntity();
        $entity->body = $getName;
        $this->todolists->save($entity);    
    }
    
}


}
