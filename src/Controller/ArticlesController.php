<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
Class ArticlesController extends AppController{

public function initialize(): void
    {
        parent::initialize();
        $this->articles = TableRegistry::getTableLocator()->get('articles');
        $this->users = TableRegistry::getTableLocator()->get('users');
        

    }
public function index(){
    
    $todolists = $this->articles->find();
    $entity = $this->articles->newEmptyEntity();
    if ($this->request->is('post')){
        $getId = $this -> request->getData('id');
        $getName = $this ->request ->getData('title');
        $getBody = $this ->request ->getData('body');
        $getNamae = $this ->request ->getData('name');
        $entity->title = $getName;
        $entity->body = $getBody;
        $entity->name = $getNamae;
        $this->articles->save($entity);    
        return $this->redirect(['action' => 'index']);
    }
    $url = 'https://weather.tsukumijima.net/api/forecast/city/130010';
    $options = array(
        'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8'
        )
    );
    $context = stream_context_create($options);

    $raw_data = file_get_contents($url, false,$context);
    $data = json_decode($raw_data,true);
    $city = ($data['location']['city']);
    $wheather = ($data['forecasts'][0]['telop']);
    $max = ($data['forecasts'][0]['temperature']['max']['celsius']);
    $min = ($data['forecasts'][0]['temperature']['min']['celsius']);
    $image  = ($data['forecasts'][0]['image']['url']);

    $http = new Client();
    $today = date("Y-m-d");
    $this -> set(compact('today')) ;
    $this->set(compact('todolists'));
    $this->set(compact('city'));
    $this->set(compact('wheather'));
    $this->set(compact('max'));
    $this->set(compact('min'));
    $this->set(compact('image'));

    
}
public function edit($id = null){
    $article = $this->Articles->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->Articles->patchEntity($article, $this->request->getData());
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('更新できました'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('更新できませんでした'));
    }
    $this->set(compact('article'));
}
public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);

    $article = $this->Articles->get($id);
    if ($this->Articles->delete($article)) {
        $this->Flash->success(__('削除しました.', $article->title));
        return $this->redirect(['action' => 'index']);
    }
}

public function api(){

}
public function result(){

}

}

