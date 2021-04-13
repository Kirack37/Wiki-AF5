<template>
    
        
        <table class="bg-blue-250 dark:bg-red-700 text-green-750 dark:text-blue-400  " >
            <thead class="bg-red-500 text-green-750 dark:bg-red-800 dark:text-blue-450">
            <tr>
                <th class="border-2 text-xs border-blue-450 text-center">
                ID
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Fecha de Inicio
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Fecha Fin
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Descripción
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Nombre
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Alias
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Responsable
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-2 text-xs border-blue-450">
                
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.id }} 
                </td>

                <td class="border-r-2 border-red-200 text-center">
                        {{ project.start_date }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.end_date }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.description }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.name }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.alias }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ project.responsible }} 
                </td>
            </tr>
            </tbody>
        </table>
    
</template> 
<script>

export default {
        props: {
                project: Object,
                allUsers: Object,
                priorities: Object,
                errors: Object,
        },
        // data: {
        //         wikiaf5projects: 'hola'
        // },
                mounted(){
                        console.log(this.project);
                }
        
        
};

</script>