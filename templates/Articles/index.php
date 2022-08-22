<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/index.css">
    <meta charset="utf-8">
    <title>ToDoリスト 入力ページ</title>
    </head>
    <body>
    <?php date_default_timezone_set ('Asia/Tokyo'); ?>
        <div class="to-do-lists-form" style="width: 80%;margin: 0 auto; position:relative;">
        <table style="width:80%; margin:0 auto;">
            <td style=" border: none; width:20%; text-align: center;"><?php echo $today ?></td>
            <td  style=" border: none; width:20%; text-align: center;"><?php echo $city."の天気" ?></td>
            <td  style=" border: none; width:20%; text-align: center;"><img src="<?= $image ?>" ></td>
            <td  style=" border: none; width:20%; text-align: center;"><?php echo "最高".$max ."度"?></td>
            <td  style=" border: none; width:20%; text-align: center;"><?php echo "最低".$min ."度"?></td>
        </table>
            <div id="modal" style="text-align: center;">
                    <button v-on:click="openModal">ToDolists</button>
                <div id="overlay" v-show="showContent" v-on:click="closeModal">
                    <transition>
                        <div id="content" v-on:click="noClick"  v-show="firstFlag" style="position: absolute; top:200px;">
                            <?=$this->Form->create(null, ['url' => ['controller' => 'Articles'], 'type' => 'post'])?>
                            <p id="p1" style="display:none; color:red;">内容を入力してください</p>
                            <p id="p2" style="display:none; color:red;">10文字以内で入力してください</p>
                            <p id="p3" style="display:none; color:red;">その文字は使用できません</p>
                            <input type="text" id="title" name="title" v-model="title">
                            <input type="date" name="body" min="<?= $today ?>" v-model="body">
                            <input type="button"  id="btnT" value="次へ" v-on:click="nextClick">
                            <?=$this->Form->end()?>
                            <button v-on:click="closeModal" style="width: 100%; margin-top:30px;">close</button>
                        </div>
                    </transition>
                    <transition>
                        <div id="content1" v-on:click="noClick" v-show="nextFlag" style="position: absolute; top:200px;">
                            <?=$this->Form->create(null, ['url' => ['controller' => 'Articles'], 'type' => 'post'])?>
                            <p id="p1" style="display:none; color:red;">内容を入力してください</p>
                            <p id="p2" style="display:none; color:red;">10文字以内で入力してください</p>
                            <p id="p3" style="display:none; color:red;">その文字は使用できません</p>
                            <input type="hidden" v-model="nextTitle" name="title">
                            <input type="hidden" v-model="nextBody" name="body">
                            <input type="text" name="name"  v-model="name">
                            <input type="button" value="戻る" v-on:click="backClick">
                            <input type="button" value="次へ" v-on:click="thirdClick">
                            <?=$this->Form->end()?>
                            <button v-on:click="closeModal" style="width: 30%; margin-top:30px;">close</button>
                        </div>
                    </transition>
                    <transition>
                        <div id="content2"  v-on:click="noClick" style="position: absolute; top:200px;" v-show="thirdFlag">
                            <?=$this->Form->create(null, ['url' => ['controller' => 'Articles'], 'type' => 'post'])?>
                                <input type="hidden" v-model="nextTitle" name="title">
                                <input type="hidden" v-model="nextBody" name="body">
                                <input type="hidden" v-model="thirdName" name="name">
                                <div>{{nextTitle}}</div>
                                <div>{{nextBody}}</div>
                                <div>{{thirdName}}</div>
                                <input type="button" value="取り消す" v-on:click="allDelete">
                            <?= $this->Form->button('登録', ['action' => 'index','id'=>'btnT','class'=>'btn-primary'])?>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="todolists" style="margin: 0 auto;width: 70%;text-align: left; background-color: white;border-radius: 10px; padding:10px;">
                <p style="text-align: center;">やることリスト</p>
                <table>
                    <tr>
                        <td>
                            
                        </td>
                        <td style="width:35%">
                            内容
                        </td>
                        <td style="width:35%">
                            期限
                        </td>
                        <td style="width:13%">
                        </td>
                        </td>
                        <td style="width:13%">
                        </td>
                        <td style="width:13%">
                        </td>
                    </tr>
                    <?php foreach ($todolists as $row): ?>
                    <tr id="td">
                        <td>
                            <i class="fa-regular fa-star"></i>
                        </td>
                        <td>
                            <?= $row->title ?>
                        </td>
                        <td>
                            <?= $row->body ?>
                        </td>
                        <td>
                            <?= $row->name ?>
                        </td>

                        <td style="width:10%">
                            <?= $this->Form->postLink('削除',['action' => 'delete', $row->id],['confirm' => '削除しますか?'],['id' => 'delete'])?>
                        </td>
                        <td style="width:10%">
                            <?= $this->html->link('編集',['action' => 'edit',$row->id]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </body>
</html>
<script>
$(function(){
    $('#button').click(function() {
        $("#delete").fadeOut(1000);
    });
});

new Vue({
    el: '#modal',
    data: {
        showContent: false,
        flag:true,
        nextFlag:false,
        firstFlag:true,
        thirdFlag:false,
        title:"",
        body:"",
        name:"",
        nextTitle:"",
        nextBody:"",
        thirdName:"",
        next:false
    },
    methods:{
    openModal: function(){
        this.showContent = true
    },
    closeModal: function(){
        this.showContent = false,
        this.nextFlag = false,
        this.thirdFlag = false,
        this.firstFlag = true
        this.title = "",
        this.body = "",
        this.name = "",
        this.nextTitle ="",
        this.nextBody = ""
    },
    stopEvent: function(){
        this.stopPropagation()
    },
    noClick: function (event) {
        event.stopPropagation();
    },
    nextClick: function () {
        const title = this.title
        const isErr = title.length > 0
        isErr.stopPropagation()
        this.nextFlag = true,
        this.firstFlag = false,
        this.nextTitle = this.title,
        this.nextBody = this.body
    },
    thirdClick: function () {
        this.thirdName = this.name,
        this.nextTitle = this.title,
        this.nextBody = this.body,
        this.thirdFlag = true,
        this.nextFlag = false
    },
    backClick: function() {
        this.nextTitle = this.title,
        this.nextBody = this.body
        this.nextFlag = false,
        this.firstFlag = true
    },
    allDelete: function () {
        this.title = "",
        this.body = "",
        this.name = "",
        this.thirdFlag = false
        this.showContent = false
    },
    computed:{
    isInValidName(){
            //文字列が4文字以上かチェックする
      return this.title.length < 4;
    }
  }
    
}
})
new Vue({
    el: '#modalEdit',
    data: {
    showContentEdit: false
    },
    methods:{
    openModalEdit: function(){
        this.showContentEdit = true
    },
    closeModalEdit: function(){
        this.showContentEdit = false
    },
    noClickEdit: function (event) {
        event.stopPropagation();
    },
    },
})

function fadeIn(node, duration) {
    if (getComputedStyle(node).display !== 'none') return;
    
    if (node.style.display === 'none') {
        node.style.display = '';
    } else {
        node.style.display = 'block';
    }
    node.style.opacity = 0;

    var start = performance.now();
    
    requestAnimationFrame(function tick(timestamp) {
        var easing = (timestamp - start) / duration;

        node.style.opacity = Math.min(easing, 1);
        if (easing < 1) {
        requestAnimationFrame(tick);
        } else {
        node.style.opacity = '';
        }
    });
}
window.addEventListener('DOMContentLoaded', () => {

    const submit = document.querySelector('#btnT');
    const title = document.querySelector('#title');

    submit.addEventListener('click', (e) => {
        const errMsgName = document.querySelector('.err-msg-name');
            if(!title.value){
                e.preventDefault();
                fadeIn(document.querySelector('#p1'), 300);
                return;
            }else if(title.value.length >= 10){
                e.preventDefault();
                fadeIn(document.querySelector('#p2'), 300);
            }else if(!title.value.match(/^[\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+$/)){
                e.preventDefault();
                fadeIn(document.querySelector('#p3'), 300);
            }
    }, );
    }, );
</script>

