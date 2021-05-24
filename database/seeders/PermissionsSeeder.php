<?php

namespace Database\Seeders;

use App\Models\WikiAf5Permission;
use Illuminate\Database\Seeder;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Notas Personales **/

        $exists = WikiAf5Permission::where('slug', 'listado_notas_personales')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de notas personales';
            $action->slug = 'listado_notas_personales';
            $action->description = 'Carga la vista del listado de notas personales (personalnotes.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_nota_personal')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de vistas personales';
            $action->slug = 'carga_form_creacion_nota_personal';
            $action->description = 'Carga la vista del formulario de creación de notas personales (personalnotes.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_nota_personal')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar nota personal';
            $action->slug = 'guardar_form_creacion_nota_personal';
            $action->description = 'Guarda en la base de datos la nota personal creada (personalnotes.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_nota_personal')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de vistas personales';
            $action->slug = 'carga_form_edicion_nota_personal';
            $action->description = 'Carga la vista del formulario de edición de notas personales (personalnotes.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_nota_personal')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar nota personal';
            $action->slug = 'guardar_form_edicion_nota_personal';
            $action->description = 'Guarda en la base de datos la nota personal editada (personalnotes.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_nota_personal')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar nota personal';
            $action->slug = 'eliminar_nota_personal';
            $action->description = 'Elimina de la base de datos la nota personal (personalnotes.destroy)';
            $action->save();
        }

        /** Clientes **/

        $exists = WikiAf5Permission::where('slug', 'listado_clientes')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de clientes';
            $action->slug = 'listado_clientes';
            $action->description = 'Carga la vista del listado de clientes (clients.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de cliente';
            $action->slug = 'carga_form_creacion_cliente';
            $action->description = 'Carga la vista del formulario de creación de clientes (clients.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar cliente';
            $action->slug = 'guardar_form_creacion_clientes';
            $action->description = 'Guarda en la base de datos el cliente creada (clients.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de cliente';
            $action->slug = 'carga_vista_cliente';
            $action->description = 'Carga la vista de detalles del cliente (clients.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de clientes';
            $action->slug = 'carga_form_edicion_cliente';
            $action->description = 'Carga la vista del formulario de edición de clientes (clients.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar cliente';
            $action->slug = 'guardar_form_edicion_cliente';
            $action->description = 'Guarda en la base de datos el cliente editado (clients.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_cliente')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar cliente';
            $action->slug = 'eliminar_cliente';
            $action->description = 'Elimina de la base de datos el cliente (clients.destroy)';
            $action->save();
        }

        /** Empresas **/

        $exists = WikiAf5Permission::where('slug', 'listado_empresas')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de empresas';
            $action->slug = 'listado_empresas';
            $action->description = 'Carga la vista del listado de empresas (companies.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de empresa';
            $action->slug = 'carga_form_creacion_empresa';
            $action->description = 'Carga la vista del formulario de creación de empresas (companies.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar empresa';
            $action->slug = 'guardar_form_creacion_empresa';
            $action->description = 'Guarda en la base de datos la empresa creada (companies.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de empresa';
            $action->slug = 'carga_vista_empresa';
            $action->description = 'Carga la vista de detalles de la empresa (companies.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de empresas';
            $action->slug = 'carga_form_edicion_empresa';
            $action->description = 'Carga la vista del formulario de edición de empresas (companies.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar empresa';
            $action->slug = 'guardar_form_edicion_empresa';
            $action->description = 'Guarda en la base de datos la empresa editada (companies.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_empresa')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar empresa';
            $action->slug = 'eliminar_empresa';
            $action->description = 'Elimina de la base de datos la empresa (companies.destroy)';
            $action->save();
        }

        /** Contactos **/

        $exists = WikiAf5Permission::where('slug', 'listado_contactos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de contactos';
            $action->slug = 'listado_contactos';
            $action->description = 'Carga la vista del listado de contactos (contacts.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de contacto';
            $action->slug = 'carga_form_creacion_contacto';
            $action->description = 'Carga la vista del formulario de creación de contactos (contacts.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar contacto';
            $action->slug = 'guardar_form_creacion_contacto';
            $action->description = 'Guarda en la base de datos el contacto creado (contacts.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de contactos';
            $action->slug = 'carga_vista_contacto';
            $action->description = 'Carga la vista de detalles del contacto (contacts.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de contactos';
            $action->slug = 'carga_form_edicion_contacto';
            $action->description = 'Carga la vista del formulario de edición del contacto (contacts.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar contacto';
            $action->slug = 'guardar_form_edicion_contacto';
            $action->description = 'Guarda en la base de datos el contacto editado (contacts.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_contacto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar contacto';
            $action->slug = 'eliminar_contacto';
            $action->description = 'Elimina de la base de datos el contacto (contacts.destroy)';
            $action->save();
        }

        /** Trabajadores externos **/

        $exists = WikiAf5Permission::where('slug', 'listado_trabajadores_externos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de trabajadores externo';
            $action->slug = 'listado_trabajadores_externos';
            $action->description = 'Carga la vista del listado de trabajadores externos (externalworkers.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de trabajador externo';
            $action->slug = 'carga_form_creacion_trabajador_externo';
            $action->description = 'Carga la vista del formulario de creación de trabajadores externos (externalworkers.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar trabajador externo';
            $action->slug = 'guardar_form_creacion_trabajador_externo';
            $action->description = 'Guarda en la base de datos el trabajador externo creado (externalworkers.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de trabajador externo';
            $action->slug = 'carga_vista_trabajador_externo';
            $action->description = 'Carga la vista de detalles del trabajador externo (externalworkers.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de trabajador externo';
            $action->slug = 'carga_form_edicion_trabajador_externo';
            $action->description = 'Carga la vista del formulario de edición del trabajador externo (externalworkers.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar trabajador externo';
            $action->slug = 'guardar_form_edicion_trabajador_externo';
            $action->description = 'Guarda en la base de datos el trabajador externo editado (externalworkers.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_trabajador_externo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar trabajador externo';
            $action->slug = 'eliminar_trabajador_externo';
            $action->description = 'Elimina de la base de datos el trabajador externo (externalworkers.destroy)';
            $action->save();
        }

        /** Reuniones **/

        $exists = WikiAf5Permission::where('slug', 'listado_reuniones')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de reuniones';
            $action->slug = 'listado_reuniones';
            $action->description = 'Carga la vista del listado de reuniones (meetings.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_lista_usuarios_reuniones')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de usuarios en reuniones';
            $action->slug = 'carga_lista_usuarios_reuniones';
            $action->description = 'Carga la vista del listado de usuarios para añadirlos a reuniones (meetings.data)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de reunión';
            $action->slug = 'carga_form_creacion_reunion';
            $action->description = 'Carga la vista del formulario de creación de reuniones (meetings.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar reunión';
            $action->slug = 'guardar_form_creacion_reunion';
            $action->description = 'Guarda en la base de datos la reunión creada (meetings.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de reuniones';
            $action->slug = 'carga_vista_reunion';
            $action->description = 'Carga la vista de detalles de la reunión (meetings.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de reuniones';
            $action->slug = 'carga_form_edicion_reunion';
            $action->description = 'Carga la vista del formulario de edición de la reunión (meetings.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar reunión';
            $action->slug = 'guardar_form_edicion_reunion';
            $action->description = 'Guarda en la base de datos la reunión editada (meetings.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar reunión';
            $action->slug = 'eliminar_reunion';
            $action->description = 'Elimina de la base de datos la reunión (meetings.destroy)';
            $action->save();
        }

        /** Logs de reuniones **/

        $exists = WikiAf5Permission::where('slug', 'listado_logs_reuniones')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de logs de reuniones';
            $action->slug = 'listado_logs_reuniones';
            $action->description = 'Carga la vista del listado de logs de reuniones (logs.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_log_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de log de reunión';
            $action->slug = 'carga_form_creacion_log_reunion';
            $action->description = 'Carga la vista del formulario de creación de log de reuniones (logs.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_log_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar log de reunión';
            $action->slug = 'guardar_form_creacion_log_reunion';
            $action->description = 'Guarda en la base de datos el log de la reunión creado (logs.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_log_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de log de reunion';
            $action->slug = 'carga_form_edicion_log_reunion';
            $action->description = 'Carga la vista del formulario de edición de log de la reunión (logs.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_log_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar log de reunión';
            $action->slug = 'guardar_form_edicion_log_reunion';
            $action->description = 'Guarda en la base de datos el log de la reunión creado (logs.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_log_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar log de la reunión';
            $action->slug = 'eliminar_log_reunion';
            $action->description = 'Elimina de la base de datos el log de la reunión (logs.destroy)';
            $action->save();
        }

         /** Notas de reuniones **/

        $exists = WikiAf5Permission::where('slug', 'listado_notas_reuniones')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de notas de reuniones';
            $action->slug = 'listado_notas_reuniones';
            $action->description = 'Carga la vista del listado de notas de las reuniones (meetingnotes.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_nota_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de nota de reunión';
            $action->slug = 'carga_form_creacion_nota_reunion';
            $action->description = 'Carga la vista del formulario de creación de notas de reuniones (meetingnotes.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_nota_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar nota de reunión';
            $action->slug = 'guardar_form_creacion_nota_reunion';
            $action->description = 'Guarda en la base de datos la nota de la reunión creada (meetingnotes.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_nota_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de notas de reuniones';
            $action->slug = 'carga_form_edicion_nota_reunion';
            $action->description = 'Carga la vista del formulario de edición de la nota de la reunión (meetingnotes.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_nota_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar nota de reunión';
            $action->slug = 'guardar_form_edicion_nota_reunion';
            $action->description = 'Guarda en la base de datos la nota de la reunión editada (meetingnotes.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_nota_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar nota de reunión';
            $action->slug = 'eliminar_nota_reunion';
            $action->description = 'Elimina de la base de datos la nota de la reunión (meetingnotes.destroy)';
            $action->save();
        }

        /** Usuarios reuniones **/

        $exists = WikiAf5Permission::where('slug', 'listado_usuarios_reuniones')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de usuarios de reuniones';
            $action->slug = 'listado_usuarios_reuniones';
            $action->description = 'Carga la vista del listado de usuarios de las reuniones (meetingusers.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_usuario_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de usuario de reunión';
            $action->slug = 'carga_form_creacion_usuario_reunion';
            $action->description = 'Carga la vista del formulario de creación de usuarios de reuniones (meetingusers.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_usuario_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar usuario de reunión';
            $action->slug = 'guardar_form_creacion_usuario_reunion';
            $action->description = 'Guarda en la base de datos el usuario de la reunión creada (meetingusers.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_usuario_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de usuarios de reuniones';
            $action->slug = 'carga_form_edicion_usuario_reunion';
            $action->description = 'Carga la vista del formulario de edición del usuario de la reunión (meetingusers.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_usuario_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar usuario de reunión';
            $action->slug = 'guardar_form_edicion_usuario_reunion';
            $action->description = 'Guarda en la base de datos el usuario de la reunión editada (meetingusers.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_usuario_reunion')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar usuario de reunión';
            $action->slug = 'eliminar_usuario_reunion';
            $action->description = 'Elimina de la base de datos el usuario de la reunión (meetingusers.destroy)';
            $action->save();
        }

        /** Patrón de trabajo **/

        $exists = WikiAf5Permission::where('slug', 'listado_patrones_trabajos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de patrones de trabajo';
            $action->slug = 'listado_patrones_trabajos';
            $action->description = 'Carga la vista del listado de patrones de trabajo (patternworks.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de patrón de trabajo';
            $action->slug = 'carga_form_creacion_patron_trabajo';
            $action->description = 'Carga la vista del formulario de creación de patrones de trabajo (patternworks.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar patrón de trabajo';
            $action->slug = 'guardar_form_creacion_patron_trabajo';
            $action->description = 'Guarda en la base de datos el patrón de trabajo creado (patternworks.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de patrones de trabajos';
            $action->slug = 'carga_vista_patron_trabajo';
            $action->description = 'Carga la vista de detalles de los patrones de trabajos (patternworks.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de patrones de trabajos';
            $action->slug = 'carga_form_edicion_patron_trabajo';
            $action->description = 'Carga la vista del formulario de edición del patrón de trabajo (patternworks.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar patrón de trabajo';
            $action->slug = 'guardar_form_edicion_patron_trabajo';
            $action->description = 'Guarda en la base de datos el patrón de trabajo editado (patternworks.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar patrón de trabajo';
            $action->slug = 'eliminar_patron_trabajo';
            $action->description = 'Elimina de la base de datos el patrón de trabajo (patternworks.destroy)';
            $action->save();
        }

        
        /** Permisos **/

        $exists = WikiAf5Permission::where('slug', 'listado_permisos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de permisos';
            $action->slug = 'listado_permisos';
            $action->description = 'Carga la vista de permisos (WikiAf5Permissions.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de permisos';
            $action->slug = 'carga_form_creacion_permiso';
            $action->description = 'Carga la vista del formulario de creación del permiso (WikiAf5Permissions.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar permiso';
            $action->slug = 'guardar_form_creacion_permiso';
            $action->description = 'Guarda en la base de datos el permiso creado (WikiAf5Permissions.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de permiso';
            $action->slug = 'carga_form_edicion_permiso';
            $action->description = 'Carga la vista del formulario de edición del permiso (WikiAf5Permissions.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar permiso';
            $action->slug = 'guardar_form_edicion_permiso';
            $action->description = 'Guarda en la base de datos el patrón del permiso editado (WikiAf5Permissions.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar permiso';
            $action->slug = 'eliminar_permiso';
            $action->description = 'Elimina de la base de datos el permiso (WikiAf5Permissions.destroy)';
            $action->save();
        }
 
        
        /** Incidencias de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_incidencias_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de incidencias de proyectos';
            $action->slug = 'listado_incidencias_proyectos';
            $action->description = 'Carga la vista del listado de patrones de trabajo (incidences.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de incidencias de proyectos';
            $action->slug = 'carga_form_creacion_incidencia_proyecto';
            $action->description = 'Carga la vista del formulario de incidencias de proyectos (incidences.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar incidencia de proyecto';
            $action->slug = 'guardar_form_creacion_incidencia_proyecto';
            $action->description = 'Guarda en la base de datos la incidencia de proyecto creado (incidences.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de incidencia del proyecto';
            $action->slug = 'carga_vista_incidencia_proyecto';
            $action->description = 'Carga la vista de detalles de la incidencia del proyecto (incidences.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de incidencias de proyectos';
            $action->slug = 'carga_form_edicion_incidencia_proyecto';
            $action->description = 'Carga la vista del formulario de edición de la incidencia del proyecto (incidences.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar incidencia de proyecto';
            $action->slug = 'guardar_form_edicion_incidencia_proyecto';
            $action->description = 'Guarda en la base de datos la indicencia del proyecto (incidences.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_incidencia_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar incidencia de proyecto';
            $action->slug = 'eliminar_incidencia_proyecto';
            $action->description = 'Elimina de la base de datos la incidencia del proyecto (incidences.destroy)';
            $action->save();
        }

        /** Notas de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_notas_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de notas de proyectos';
            $action->slug = 'listado_notas_proyectos';
            $action->description = 'Carga la vista del listado de notas del proyecto (notes.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_nota_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de notas de proyectos';
            $action->slug = 'carga_form_creacion_nota_proyecto';
            $action->description = 'Carga la vista del formulario de notas de proyectos (notes.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_nota_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar nota de proyecto';
            $action->slug = 'guardar_form_creacion_nota_proyecto';
            $action->description = 'Guarda en la base de datos la nota de proyecto creada (notes.store)';
            $action->save();
        }

        // $exists = WikiAf5Permission::where('slug', 'carga_vista_patron_trabajo')->first();
        // if(!isset($exists)){
        //     $action = new WikiAf5Permission;
        //     $action->name = 'Carga de la vista de detalles de patrones de trabajos';
        //     $action->slug = 'carga_vista_patron_trabajo';
        //     $action->description = 'Carga la vista de detalles de los patrones de trabajos (notes.show)';
        //     $action->save();
        // }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_nota_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de notas de proyectos';
            $action->slug = 'carga_form_edicion_nota_proyecto';
            $action->description = 'Carga la vista del formulario de edición de la nota del proyecto (notes.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_nota_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar nota de proyecto';
            $action->slug = 'guardar_form_edicion_nota_proyecto';
            $action->description = 'Guarda en la base de datos la nota del proyecto (notes.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_nota_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar nota de proyecto';
            $action->slug = 'eliminar_nota_proyecto';
            $action->description = 'Elimina de la base de datos la nota del proyecto (notes.destroy)';
            $action->save();
        }

        /** Proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de proyectos';
            $action->slug = 'listado_proyectos';
            $action->description = 'Carga la vista del listado de proyectos (projects.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_lista_usuarios_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de usuarios en proyectos';
            $action->slug = 'carga_lista_usuarios_proyectos';
            $action->description = 'Carga la vista del listado de usuarios para añadirlos a proyectos (projects.data)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de proyecto';
            $action->slug = 'carga_form_creacion_proyecto';
            $action->description = 'Carga la vista del formulario de proyectos (projects.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar proyecto';
            $action->slug = 'guardar_form_creacion_proyecto';
            $action->description = 'Guarda en la base de datos el proyecto creado (projects.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de proyectos';
            $action->slug = 'carga_vista_proyecto';
            $action->description = 'Carga la vista de detalles de los proyectos (projects.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de proyecto';
            $action->slug = 'carga_form_edicion_proyecto';
            $action->description = 'Carga la vista del formulario de edición del proyecto (projects.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar proyecto';
            $action->slug = 'guardar_form_edicion_proyecto';
            $action->description = 'Guarda en la base de datos el proyecto (projects.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar proyecto';
            $action->slug = 'eliminar_proyecto';
            $action->description = 'Elimina de la base de datos el proyecto (projects.destroy)';
            $action->save();
        }

        /** Entornos de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_entornos_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de entornos del proyecto';
            $action->slug = 'listado_entornos_proyectos';
            $action->description = 'Carga la vista del listado de entornos del proyecto (enviroments.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de proyecto';
            $action->slug = 'carga_form_creacion_entorno_proyecto';
            $action->description = 'Carga la vista del formulario de entornos de proyectos (enviroments.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar entorno de proyecto';
            $action->slug = 'guardar_form_creacion_entorno_proyecto';
            $action->description = 'Guarda en la base de datos el entorno de proyecto creado (enviroments.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'vista_detalles_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga vista detalles entorno proyecto';
            $action->slug = 'vista_detalles_entorno_proyecto';
            $action->description = 'Carga la vista de detalles del entorno del proyecto';
            $action->save();
        }
        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de proyecto';
            $action->slug = 'carga_form_edicion_entorno_proyecto';
            $action->description = 'Carga la vista del formulario de edición del entorno del proyecto (enviroments.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar entorno de proyecto';
            $action->slug = 'guardar_form_edicion_entorno_proyecto';
            $action->description = 'Guarda en la base de datos el entorno del proyecto (enviroments.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_entorno_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar entorno de proyecto';
            $action->slug = 'eliminar_entorno_proyecto';
            $action->description = 'Elimina de la base de datos el entorno del proyecto (enviroments.destroy)';
            $action->save();
        }

        
        /** GITs de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_gits')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de GITs del proyecto';
            $action->slug = 'listado_gits';
            $action->description = 'Carga la vista del listado de GITs del proyecto (gits.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_git')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de GIT del proyecto';
            $action->slug = 'carga_form_creacion_git';
            $action->description = 'Carga la vista del formulario de GIT del proyecto (gits.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_git')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar GIT del proyecto';
            $action->slug = 'guardar_form_creacion_git';
            $action->description = 'Guarda en la base de datos el GIT del proyecto creado (gits.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_git')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de GIT del proyecto';
            $action->slug = 'carga_form_edicion_git';
            $action->description = 'Carga la vista del formulario de edición del GIT del proyecto (gits.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_git')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar GIT del proyecto';
            $action->slug = 'guardar_form_edicion_git';
            $action->description = 'Guarda en la base de datos el GIT del proyecto (gits.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_git')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar GIT del proyecto';
            $action->slug = 'eliminar_git';
            $action->description = 'Elimina de la base de datos el GIT del proyecto (gits.destroy)';
            $action->save();
        }

           
        /** Historiales de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_historiales_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de historiales del proyecto';
            $action->slug = 'listado_historiales_proyecto';
            $action->description = 'Carga la vista del listado de historiales del proyecto (history.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_historial_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de historial del proyecto';
            $action->slug = 'carga_form_creacion_historial_proyecto';
            $action->description = 'Carga la vista del formulario de historial del proyecto (history.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_historial_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar historial del proyecto';
            $action->slug = 'guardar_form_creacion_historial_proyecto';
            $action->description = 'Guarda en la base de datos el historial del proyecto creado (history.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_historial_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de historial de proyecto';
            $action->slug = 'carga_form_edicion_historial_proyecto';
            $action->description = 'Carga la vista del formulario de edición del historial del proyecto (history.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_historial_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar historial del proyecto';
            $action->slug = 'guardar_form_edicion_historial_proyecto';
            $action->description = 'Guarda en la base de datos el historial del proyecto (history.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_historial_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar historial del proyecto';
            $action->slug = 'eliminar_historial_proyecto';
            $action->description = 'Elimina de la base de datos el historial del proyecto (history.destroy)';
            $action->save();
        }

               
        /** Fases de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_fases_proyectos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de fases del proyecto';
            $action->slug = 'listado_fases_proyectos';
            $action->description = 'Carga la vista del listado de fases del proyecto (phases.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_fase_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de fase del proyecto';
            $action->slug = 'carga_form_creacion_fase_proyecto';
            $action->description = 'Carga la vista del formulario de fase del proyecto (phases.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_fase_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar fase del proyecto';
            $action->slug = 'guardar_form_creacion_fase_proyecto';
            $action->description = 'Guarda en la base de datos la fase del proyecto creado (phases.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_fase_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de fase de proyecto';
            $action->slug = 'carga_form_edicion_fase_proyecto';
            $action->description = 'Carga la vista del formulario de edición del fase del proyecto (phases.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_fase_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar fase del proyecto';
            $action->slug = 'guardar_form_edicion_fase_proyecto';
            $action->description = 'Guarda en la base de datos la fase del proyecto (phases.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_fase_proyecto')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar fase del proyecto';
            $action->slug = 'eliminar_fase_proyecto';
            $action->description = 'Elimina de la base de datos la fase del proyecto (phases.destroy)';
            $action->save();
        }
                       
        /** Trellos de proyectos **/

        $exists = WikiAf5Permission::where('slug', 'listado_trellos')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de Trellos del proyecto';
            $action->slug = 'listado_trellos';
            $action->description = 'Carga la vista del listado de Trellos del proyecto (trello.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_trello')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de Trello del proyecto';
            $action->slug = 'carga_form_creacion_trello';
            $action->description = 'Carga la vista del formulario de Trello del proyecto (trello.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_trello')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar Trello del proyecto';
            $action->slug = 'guardar_form_creacion_trello';
            $action->description = 'Guarda en la base de datos el Trello del proyecto creado (trello.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_trello')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de Trello de proyecto';
            $action->slug = 'carga_form_edicion_trello';
            $action->description = 'Carga la vista del formulario de edición del Trello del proyecto (trello.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_trello')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar Trello del proyecto';
            $action->slug = 'guardar_form_edicion_trello';
            $action->description = 'Guarda en la base de datos el Trello del proyecto (trello.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_trello')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar Trello del proyecto';
            $action->slug = 'eliminar_trello';
            $action->description = 'Elimina de la base de datos el Trello del proyecto (trello.destroy)';
            $action->save();
        }


        /** Actas de reuniones **/

        $exists = WikiAf5Permission::where('slug', 'listado_actas')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de actas de reuniones';
            $action->slug = 'listado_actas';
            $action->description = 'Carga la vista del listado de actas de reuniones (reports.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_acta')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de acta de reunión';
            $action->slug = 'carga_form_creacion_acta';
            $action->description = 'Carga la vista del formulario de acta de reunión (reports.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_acta')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar de acta de reunión';
            $action->slug = 'guardar_form_creacion_acta';
            $action->description = 'Guarda en la base de datos el acta de reunión creado (reports.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_acta')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de acta de reunión';
            $action->slug = 'carga_form_edicion_acta';
            $action->description = 'Carga la vista del formulario de edición del acta de reunión (reports.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_acta')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar acta de reunión';
            $action->slug = 'guardar_form_edicion_acta';
            $action->description = 'Guarda en la base de datos el acta de reunión (reports.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_acta')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar acta de reunión';
            $action->slug = 'eliminar_acta';
            $action->description = 'Elimina de la base de datos el acta de reunión (reports.destroy)';
            $action->save();
        }


        /** Roles **/

        $exists = WikiAf5Permission::where('slug', 'listado_roles')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de roles';
            $action->slug = 'listado_roles';
            $action->description = 'Carga la vista del listado de actas de reuniones (roles.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_lista_usuarios_roles')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de usuarios en roles';
            $action->slug = 'carga_lista_usuarios_roles';
            $action->description = 'Carga la vista del listado de usuarios para añadirlos a roles (roles.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_lista_permisos_roles')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de permisos en roles';
            $action->slug = 'carga_lista_permisos_roles';
            $action->description = 'Carga la vista del listado de permisos para añadirlos a roles (roles.data)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de rol';
            $action->slug = 'carga_form_creacion_rol';
            $action->description = 'Carga la vista del formulario de rol (roles.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar rol';
            $action->slug = 'guardar_form_creacion_rol';
            $action->description = 'Guarda en la base de datos el rol creado (roles.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Cargar vista detallada del rol';
            $action->slug = 'carga_vista_rol';
            $action->description = 'Carga la vista detallada del rol creado (roles.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de rol';
            $action->slug = 'carga_form_edicion_rol';
            $action->description = 'Carga la vista del formulario de edición del rol (roles.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_usuario_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario deusuario en rol';
            $action->slug = 'carga_form_edicion_usuario_rol';
            $action->description = 'Carga la vista del formulario de edición del usuario en el rol (editusers)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_permiso_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de permiso em rol';
            $action->slug = 'carga_form_edicion_permiso_rol';
            $action->description = 'Carga la vista del formulario de edición del permiso en el rol (editpermissions)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar rol';
            $action->slug = 'guardar_form_edicion_rol';
            $action->description = 'Guarda en la base de datos el rol (roles.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_usuario_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar usuario en rol';
            $action->slug = 'guardar_form_edicion_usuario_rol';
            $action->description = 'Guarda en la base de datos el usuario del rol (updateroles)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_permisos_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar permiso en el rol';
            $action->slug = 'guardar_form_edicion_permisos_rol';
            $action->description = 'Guarda en la base de datos el permiso del rol (updatepermissions)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_rol')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar rol';
            $action->slug = 'eliminar_rol';
            $action->description = 'Elimina de la base de datos el rol (roles.destroy)';
            $action->save();
        }

        /** Servicios web **/

        $exists = WikiAf5Permission::where('slug', 'listado_servicios_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de servicios web';
            $action->slug = 'listado_servicios_web';
            $action->description = 'Carga la vista del listado de servicios web (webservices.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de servicio web';
            $action->slug = 'carga_form_creacion_servicio_web';
            $action->description = 'Carga la vista del formulario de servicio web (webservices.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar servicio web';
            $action->slug = 'guardar_form_creacion_servicio_web';
            $action->description = 'Guarda en la base de datos el servicio web creado (webservices.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_vista_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles del servicio web';
            $action->slug = 'carga_vista_servicio_web';
            $action->description = 'Carga la vista de detalles del servicio web (webservices.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de servicio web';
            $action->slug = 'carga_form_edicion_servicio_web';
            $action->description = 'Carga la vista del formulario de edición del servicio web (webservices.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar servicio web';
            $action->slug = 'guardar_form_edicion_servicio_web';
            $action->description = 'Guarda en la base de datos el servicio web (webservices.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_servicio_web')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar servicio web';
            $action->slug = 'eliminar_servicio_web';
            $action->description = 'Elimina de la base de datos el servicio web (webservices.destroy)';
            $action->save();
        }

        /** Usuarios **/

        $exists = WikiAf5Permission::where('slug', 'listado_usuarios')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de usuarios';
            $action->slug = 'listado_usuarios';
            $action->description = 'Carga la vista del listado de usuarios (wikiusers.index)';
            $action->save();
        }
    
        $exists = WikiAf5Permission::where('slug', 'carga_vista_usuario')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de la vista de detalles de usuarios';
            $action->slug = 'carga_vista_usuario';
            $action->description = 'Carga la vista de detalles del usuario (wikiusers.show)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_usuario')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de usuario';
            $action->slug = 'carga_form_edicion_usuario';
            $action->description = 'Carga la vista del formulario de edición del usuario (wikiusers.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_usuario')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar usuario';
            $action->slug = 'guardar_form_edicion_usuario';
            $action->description = 'Guarda en la base de datos el usuario (wikiusers.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_usuario')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar usuario';
            $action->slug = 'eliminar_usuario';
            $action->description = 'Elimina de la base de datos el usuario (wikiusers.destroy)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'cargar_registro_usuarios')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Registro de usuario';
            $action->slug = 'cargar_registro_usuarios';
            $action->description = 'Entrar al registro del usuario';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'crear_usuario')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Crear usuario';
            $action->slug = 'crear_usuario';
            $action->description = 'Crear un nuevo usuario';
            $action->save();
        }
    }
}
