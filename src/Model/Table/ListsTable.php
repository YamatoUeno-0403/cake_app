<?php
namespace App\Model\Table;
use Cake\Validation\Validator;
use Cake\ORM\Table;

class ListsTable extends Table
{
    public function initialize(array $config) : void
    {
        $this->addBehavior('Timestamp');
    }
    public function validationDefault(Validator $validator): Validator {
        $validator = new Validator();
        $validator
            ->notEmptyString('body')
            ->minLength('body',1,'1文字以上で入力してください。');
        return $validator;
    }
}