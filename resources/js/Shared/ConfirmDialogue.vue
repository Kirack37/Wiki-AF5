<template>
    <popup-modal ref="popup">
        <h2 style="margin-top: 0">{{ title }}</h2>
        <p>{{ message }}</p>
        <div class="btns">
            <span class="ok-btn" @click="_confirm">{{ okButton }}</span>
            <button class="cancel-btn" @click="_cancel">{{ cancelButton }}</button>
        </div>
    </popup-modal>
</template>

<script>
import PopupModal from '@/Shared/PopupModal.vue'

export default {
    name: 'ConfirmDialogue',

    components: { PopupModal },

    data: () => ({
        // Parameters that change depending on the type of dialogue
        title: undefined,
        message: undefined, // Main text content
        okButton: undefined, // Text for confirm button; leave it empty because we don't know what we're using it for
        cancelButton: 'Volver', // text for cancel button
        
        // Private variables
        resolvePromise: undefined,
        rejectPromise: undefined,
    }),

    methods: {
        show(opts = {}) {
            this.title = opts.title
            this.message = opts.message
            this.okButton = opts.okButton
            if (opts.cancelButton) {
                this.cancelButton = opts.cancelButton
            }
            // Once we set our config, we tell the popup modal to open
            this.$refs.popup.open()
            // Return promise so the caller can get results
            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(true)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
            // Or you can throw an error
            // this.rejectPromise(new Error('User cancelled the dialogue'))
        },
    },
}
</script>

<style scoped>
.btns {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 1em;
}

.ok-btn {
    padding: 0.5em 1em;
    background-color: #eb5050;
    color: #ffffff;
    border: 2px solid #ff0000;
    border-radius: 5px;
    font-weight: bold;
    font-size: 14px;
    text-transform: uppercase;
    cursor: pointer;
}

.cancel-btn {
    padding: 0.5em 1em;
    background-color: #eb9240;
    color: #ffffff;
    border: 2px solid #ff8800;
    border-radius: 5px;
    font-weight: bold;
    font-size: 14px;
    text-transform: uppercase;
    cursor: pointer;
}
</style>