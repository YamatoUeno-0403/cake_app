<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ToDoリスト 入力ページ</title>
<style type="text/css">
	body {
		background-color: #f9fff2;
	}
	.input-area {
		margin-bottom: 20px;
	}
	input[type="text"],input[type="email"],select {
		width: 300px;
		height: 30px;
	}
	textarea {
		width: 300px;
	}
	p {
		font-weight: bold;
		font-size: 20px;
	}
	.btn-border {
		display: inline-block;
		max-width: 180px;
		text-align: left;
		border: 2px solid #9ec34b;
		font-size: 15px;
		color: #9ec34b;
		text-decoration: none;
		font-weight: bold;
		padding: 8px 16px;
		border-radius: 4px;
		transition: .4s;
	}
	.btn-border:hover {
		background-color: #9ec34b;
		border-color: #cbe585;
		color: #FFF;
	}
</style>
</head>
<body>
<div class="to-do-lists-form" style="width: 80%;margin: 0 auto;">
    <?=$this->Form->create(null, ['url' => ['controller' => 'Lists'], 'type' => 'post'])?>
    <?= $this->form->text('',['name'=>'body','class'=>'form-control','placeholder'=>'内容'])?>
    <?= $this->Form->button('登録', ['action' => 'index','name'=>'btnT','class'=>'btn-primary'])?>
    <?=$this->Form->end()?>
    <p><button v-on:click="closeModal">close</button></p>
</div>
<?php foreach ($todolists as $row): ?>
    <p><?= $row->body ?></p>
<?php endforeach; ?>

</body>
</html>
<script src="/js/common.js"></script>