<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Clientes
            </h2>
        </template>
        <sidebar-modal ref="ContentDialogue">
          {{message}}

        </sidebar-modal>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ConfirmDialogue from '@/Shared/ConfirmDialogue.vue'
    import SidebarModal from '@/Shared/SidebarModal.vue'

    export default {
        components: {
            AppLayout,
            ConfirmDialogue,
            SidebarModal 
        },
         data: () => ({
      
        message: 'Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 
       
    }),
        methods: {
            toggle() {
                this.open = !this.open;
            },
        },
    }
</script>

<style scoped>

</style>

