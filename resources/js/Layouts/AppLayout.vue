<template>
    <div>
        <jet-banner />

        <div class="min-h-screen">
            <nav class="bg-white border-b border-gray-100 sticky top-0 z-10">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- <flash-messages /> -->
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('dashboard')">
                                    <jet-application-mark class="block h-12 w-auto" />
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                    Inicio
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('projects')" :active="route().current('projects')">
                                    Proyectos
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('meetings')" :active="route().current('meetings')">
                                    Reuniones
                                </jet-nav-link>
                            </div>
                            <div class="group inline-block hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <button class="outline-none focus:outline-none bg-white rounded-sm flex items-center min-w-32">
                                    <p class="pr-1 text-sm text-gray-900 flex-1">Personal externo</p>
                                    <svg
                                        class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                        transition duration-150 ease-in-out"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </button>
                                <ul class="mt-14 bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute 
                                transition duration-150 ease-in-out origin-top min-w-32">
                                    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">
                                        <jet-nav-link :href="route('clients')" :active="route().current('clients')">Clientes</jet-nav-link>
                                    </li>
                                    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">
                                        <jet-nav-link :href="route('externalworkers')" :active="route().current('externalworkers')">Trabajadores Externos</jet-nav-link>
                                    </li>
                                    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">
                                        <jet-nav-link :href="route('contacts')" :active="route().current('contacts')">Contactos</jet-nav-link>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('contacts')" :active="route().current('contacts')">
                                    Contactos
                                </jet-nav-link>
                            </div> -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('companies')" :active="route().current('companies')">
                                    Empresas
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('wikiusers')" :active="route().current('wikiusers')">
                                    Usuarios
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('roles')" :active="route().current('roles')">
                                    Roles
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('personalnotes')" :active="route().current('personalnotes')">
                                    Notas personales
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-500 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Log Out
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>

                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="main-content">
                    <slot></slot>
                    <!-- <Component
                        v-bind="$page.props"
                        v-if="$root.modalComponent"
                        :is="$root.modalComponent"
                    /> -->
                </div>
            </main>
            <footer>
                <!-- Footer -->
            <div class="page-footer-container mt-12">
                <div class="z-0" style="backgroundColor: #EA891B">
                    <div class="container-rrss">
                        <div class="py-4 flex justify-between">
                            <div class="text-center ml-6 flex-initial">
                                <h6 class="mb-0 text-white font-medium text-lg">Wiki Área F5</h6>
                            </div>
                            <div class="mr-10">
                                <a href="https://www.facebook.com/Web.Area.f5/" target="_blank" class="mr-4 "><font-awesome-icon :icon="['fab', 'facebook-square']" size="2x" /></a>
                                <a href="https://twitter.com/area_f5?lang=es" target="_blank" class="mr-4"><font-awesome-icon :icon="['fab', 'twitter-square']" size="2x" /></a>
                                <a href="https://www.linkedin.com/company/%C3%A1rea-f5" target="_blank"><font-awesome-icon :icon="['fab', 'linkedin']" size="2x" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-container flex pt-10 bg-white z-0">
                    <div class="footer-info flex-1 ml-6 mr-10">
                        <h6 class="mb-8"><strong class="underlined-footer-text uppercase font-bold border-b-2 border-yellow-600 pb-1">Área F5</strong></h6>
                        <p>Wiki oficial de la empresa Área F5.</p>
                        <img class="mt-12" src="/../../images/logo_blanco.png">
                        
                        
                        
                    </div>
                    <div class="footer-links flex-1 mr-10">
                        <h6 class="mb-8"><strong class="underlined-footer-text uppercase font-bold border-b-2 border-yellow-600 pb-1">Enlaces de interés</strong></h6>
                        <p class="footer-link"><a href="https://areaf5.es/">Página oficial Área F5</a></p>
                        <inertia-link class="footer-link" :href="route('patternworks')"><p class="footer-link mb-6">Guía de estilo Área F5</p></inertia-link>
                        <inertia-link class="footer-link" :href="route('patternworks')"><p class="footer-link mb-6">Patrones de trabajo</p></inertia-link>
                        <inertia-link class="footer-link" :href="route('patternworks')"><p class="footer-link mb-6">Aviso legal</p></inertia-link>
                        <inertia-link class="footer-link" :href="route('patternworks')"><p class="footer-link mb-6">Política de privacidad</p></inertia-link>
                        <inertia-link class="footer-link" :href="route('patternworks')"><p class="footer-link mb-6">Política de cookies</p></inertia-link>
                    </div>
                    <div class="footer-contact flex-1">
                        <h6 class="mb-8"><strong class="underlined-footer-text uppercase font-bold border-b-2 border-yellow-600 pb-1">Contacto</strong></h6>
                        <p class="footer-link"><font-awesome-icon :icon="['fas', 'home']" size="lg"/>Calle Melilla 1, Local 21, Churriana de la Vega (Granada).</p>
                        <p class="footer-icons footer-link"><font-awesome-icon :icon="['fas', 'envelope']" size="lg"/><a href="mailto:info@areaf5.es" target="_blank">info@areaf5.es</a></p>
                        <p class="footer-icons footer-link"><font-awesome-icon :icon="['fas', 'phone']" size="lg"/>Granada: <a href="tel:633659920">633 65 99 20</a></p>
                        <p class="footer-icons footer-link"><font-awesome-icon :icon="['fas', 'phone']" size="lg"/>Dúrcal: <a href="tel:679749395">679 749 395</a></p>
                        <p class="footer-icons footer-link"><font-awesome-icon :icon="['fas', 'phone']" size="lg"/>Córdoba: <a href="tel:622326229">622 326 229</a></p>
                    </div>
                </div>
                <div class="footer-copyright text-center pt-8 pb-10">
                    <div fluid>
                        <p>&copy; 2021 Copyright: <a href="https://www.areaf5.es"> Área F5 </a></p>
                    </div>
                </div>
            </div>
        </footer>
        </div>  
    </div>
</template>

<style>
  /* since nested groupes are not supported we have to use 
     regular css for the nested dropdowns 
  */
  li>ul                 { transform: translatex(100%) scale(0) }
  li:hover>ul           { transform: translatex(101%) scale(1) }
  li > button svg       { transform: rotate(-90deg) }
  li:hover > button svg { transform: rotate(-270deg) }

  /* Below styles fake what can be achieved with the tailwind config
     you need to add the group-hover variant to scale and define your custom
     min width style.
  	 See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
  	 for implementation with config file
  */
  .group:hover .group-hover\:scale-100 { transform: scale(1) }
  .group:hover .group-hover\:-rotate-180 { transform: rotate(180deg) }
  .scale-0 { transform: scale(0) }
  .min-w-32 { min-width: 8rem }
</style>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    import FlashMessages from '@/Shared/FlashMessages'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            FlashMessages,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
