
<template>
  <div id="app">
    <div class="toggle">
      <button @click="toggle">Toggle SlideIn</button>
    </div> 
    <transition name="slide">
      <div class="slidein-middle" v-if="open">
        <button class="close-btn" @click="toggle">X</button>
        <slot></slot>
      </div>
    </transition>
  </div>
</template>

<script>

export default {
    name: 'MiddleModal',

  data() {
    return {
      open: false
    };
  },
   methods: {
            toggle() {
                this.open = !this.open;
            },
        },
};
</script>
