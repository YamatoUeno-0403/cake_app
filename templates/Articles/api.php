<template>
  <div id="app">
    <input type="text" v-on:input="inputEvent">
  </div>
</template>
<script>
new Vue( {
  name: 'App',
  methods:{
    inputEvent(event) {
      console.log(event.target.value);
    }
  }
})
</script>