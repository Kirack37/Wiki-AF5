<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Proyectos
            </h2>
        </template>
        <div class="container mx-auto my-10">
            <div class="select-stuff mb-20">
                <h3>Selecciona el proyecto que deseas buscar</h3>
                <form name="projects" action="POST">
                    <select class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option>Proyecto 1</option>
                        <option>Proyecto 2</option>
                        <option>Proyecto 3</option>
                        <option>Proyecto 4</option>
                    </select>
                </form>
            </div>
            <div class="recent-projects">
                <h3>Proyectos más recientes</h3>
                <p>Lorem Ipsum</p>
            </div>  
        </div>
        <div class="grid grid-cols-12 opacity-90"> 
      <div class="col-span-10 col-start-2 hidden md:grid mt-10">
        <show :wiki_af5_projects="wiki_af5_projects" />
      </div>
    </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    // import Show from "@/Pages/Show/ShowProjects";


    export default {
        props: {
            wiki_af5_projects: new Object,
         },
        components: {
            AppLayout,
            Show,
        },
    }
</script>
