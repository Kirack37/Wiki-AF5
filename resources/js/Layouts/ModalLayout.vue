<template>
    <div>
        <slot></slot>

        <Component
            v-bind="$page.props"
            v-if="$root.modalComponent"
            :is="$root.modalComponent"
        />
    </div>
</template>