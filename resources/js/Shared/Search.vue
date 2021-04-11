<template>
  <div class="flex items-center">
    <div class="flex w-full bg-white shadow rounded">
       <input class="relative w-full px-6 py-3 rounded focus:ring focus:ring-yellow-600 z-0" id="search" autocomplete="on" type="text" name="search" placeholder="Buscar…" :value="search" @input="$emit('update:search', $event.target.value)" />
    </div>
    <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-red-500 text-yellow-600 border-2 rounded-md p-3 bg-white" type="button" click="document.getElementByTagName('search').value = ''" @reset="$emit('delete:search', $event.target.value)">Resetear</button>
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