<template>
    <div>
        <input id="trix" type="hidden" :name="name"  :value="value">
        <trix-editor ref="trix" :class="{ 'is-invalid': error }" input="trix" :placeholder="placeholder"></trix-editor>

        <span v-if="error" class="invalid-feedback d-block">
            <strong class="text-danger" v-text="error"></strong>
        </span>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value', 'error', 'placeholder', 'clear'],

        watch: {
            clear() {
                this.$refs.trix.value = '';
            }
        },

        mounted() {
            this.$refs.trix.addEventListener('trix-change', e => {
                this.$emit('input', e.target.innerHTML);
                this.$emit('keydown', e.target.innerHTML);
            });
        }
    }
</script>

<style>
    .trix-button {
        box-shadow: none !important;
        border: none !important;
        background-color: #fff !important;
    }

    .trix-button:hover {
        background-color: #dee2e6 !important;
        transition: .3s;
    }

    .trix-button-group {
        border-color: #ced4da !important;
    }

    .trix-active {
        background-color: #ced4da !important;
    }

    trix-editor {
        margin-top: -7px;
        border-color: #ced4da !important;
        /*min-height: 150px;*/
        background-color: #fff;
    }

    trix-editor.is-invalid {
        border-color: #ef5350 !important;
    }
</style>
