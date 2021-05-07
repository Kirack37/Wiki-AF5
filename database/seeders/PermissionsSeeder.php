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
            $action->description = 'Carga la vista de permisos (permissions.index)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_creacion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de creación de permisos';
            $action->slug = 'carga_form_creacion_permiso';
            $action->description = 'Carga la vista del formulario de creación del permiso (permissions.create)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_creacion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Guardar permiso';
            $action->slug = 'guardar_form_creacion_permiso';
            $action->description = 'Guarda en la base de datos el permiso creado (permissions.store)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de permiso';
            $action->slug = 'carga_form_edicion_permiso';
            $action->description = 'Carga la vista del formulario de edición del permiso (permissions.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar permiso';
            $action->slug = 'guardar_form_edicion_permiso';
            $action->description = 'Guarda en la base de datos el patrón del permiso editado (permissions.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_permiso')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar permiso';
            $action->slug = 'eliminar_permiso';
            $action->description = 'Elimina de la base de datos el permiso (permissions.destroy)';
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
            $action->description = 'Carga la vista del formulario de de incidencias de proyectos (incidences.create)';
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

        // $exists = WikiAf5Permission::where('slug', 'carga_vista_patron_trabajo')->first();
        // if(!isset($exists)){
        //     $action = new WikiAf5Permission;
        //     $action->name = 'Carga de la vista de detalles de patrones de trabajos';
        //     $action->slug = 'carga_vista_patron_trabajo';
        //     $action->description = 'Carga la vista de detalles de los patrones de trabajos (incidences.show)';
        //     $action->save();
        // }

        $exists = WikiAf5Permission::where('slug', 'carga_form_edicion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Carga de formulario de edición de patrones de trabajos';
            $action->slug = 'carga_form_edicion_patron_trabajo';
            $action->description = 'Carga la vista del formulario de edición del patrón de trabajo (incidences.edit)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'guardar_form_edicion_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Actualizar patrón de trabajo';
            $action->slug = 'guardar_form_edicion_patron_trabajo';
            $action->description = 'Guarda en la base de datos el patrón de trabajo editado (incidences.update)';
            $action->save();
        }

        $exists = WikiAf5Permission::where('slug', 'eliminar_patron_trabajo')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Eliminar patrón de trabajo';
            $action->slug = 'eliminar_patron_trabajo';
            $action->description = 'Elimina de la base de datos el patrón de trabajo (incidences.destroy)';
            $action->save();
        }

    }
}
