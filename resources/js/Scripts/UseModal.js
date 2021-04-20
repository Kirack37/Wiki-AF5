const useModal = {
    computed: {
        modalComponent() {
            return this.$page.props.modal ?
                () =>
                import (`@/Pages/${this.$page.props.modal}`) :
                false
        }
    }
}

export { useModal }