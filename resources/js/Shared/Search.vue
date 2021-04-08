<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white shadow rounded">
       <input class="relative w-full px-6 py-3 rounded-r focus:ring" id="search" autocomplete="off" type="text" name="search" placeholder="Search…" :value="search" @input="$emit('update:search', $event.target.value)" />
    </div>
    <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" click="document.getElementByTagName('search').value = ''" @reset="$emit('delete:search', $event.target.value)">Resetear</button>
  </div>
</template>

<script>

export default {
  components: {
   
  },
  props: {
    search: {
      type: String,
      default: ''
    }
  },
   emits: ['update:search', 'delete:search'],
}
</script>