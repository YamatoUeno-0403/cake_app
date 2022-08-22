<html>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js'></script><!-- 2019-01-25 https://cdnjs.com/libraries/vue -->
<body>

<div id="vue_example"></div>
<div id="second_vue"></div>
<div id="vue_example1"></div>

<script>
var vue_example = new Vue({
  el: '#vue_example',

  template: `<div>
    <p>{{ message }}</p>
    <input v-model="message" />
    <button v-on:click="reverse()">Reverse</button>
    </div>`,

  data: {
    message: 'Hello Vue.js!',
  },

  methods: {
    reverse: function () {
      this.message = this.message.split('').reverse().join('')
    },
  },
})

var second_vue = new Vue({
    el:'#second_vue',

    template: `<div>
    <p v-if="!message1">こんにちわ</p>
    <p v-if="message1">こんばんわ</p>
    <button v-on:click="chenge()">変更</button>
    </div>`,

    data: {
        message: true,
        message1: false,
    },
    methods:{
        chenge: function(){
            this.message1 = true
        },
    }
})

var vue_example1 = new Vue({
  el: '#vue_example1',

  template: `<div>
    <ol><li v-for="(it,idx) in items">
    {{ it }} <button v-on:click="del_item( idx )"> x </button>
    </li></ol>
    <input v-model="item" />
    <button v-on:click="add_item()">Add Item</button>
    </div>`,

  data: {
    items: [ 'aaa', 'bbb', 'ccc', ],
    item: 'Hello Vue.js!',
  },

  methods: {
    add_item: function () { this.items.push( this.item ) },
    del_item: function ( _idx ) { this.items.splice( _idx, 1 ) }
  }
})
</script>
</body>
</html>