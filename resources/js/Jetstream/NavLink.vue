<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-600 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus: border-b-3 border-yellow-600 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-600 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover: border-b-3 border-yellow-600 focus:outline-none focus:text-gray-700 focus:border-b-3 border-yellow-600 transition duration-150 ease-in-out'
            }
        }
    }
</script>
