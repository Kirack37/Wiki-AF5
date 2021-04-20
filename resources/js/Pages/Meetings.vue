<template>

    <app-layout>

        <template #header>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                Manage Post - (Laravel 8 Inertia JS CRUD with Jetstream & Tailwind CSS - ItSolutionStuff.com)

            </h2>

        </template>


        <div class="py-12">

      
        <button class="inside-project text-yellow-600" 
            v-bind="$page.props" 
            v-if="$root.modalComponent" 
            :is="$root.modalComponent">Click here</button>
            HOLA 
            

        </div>

    </app-layout>

</template>

<script>

    import AppLayout from './../Layouts/AppLayout'

    import Welcome from './../Jetstream/Welcome'

    import {useModal} from "@/Scripts/UseModal"

    export default {

        components: {

            AppLayout,

            Welcome,
            useModal
           
            

        },
        mixins: [useModal],

    }

</script>

<style scope>
.modal-route {
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background: rgba($color: #000000, $alpha: 0.5);
}
  .modal-content {
    width: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
  }
</style>

