<template>
    <div>
        <input id="trix" type="hidden" :name="name"  :value="value">
        <trix-editor :class="{ 'is-invalid': error }" input="trix"></trix-editor>

        <span v-if="error" class="invalid-feedback d-block">
            <strong v-text="error"></strong>
        </span>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value', 'error']
    }
</script>

<style>
    .trix-button {
        box-shadow: none !important;
        border: none !important;
    }

    .trix-button:hover {
        background-color: #dee2e6;
        transition: .3s;
    }

    .trix-button-group {
        border-color: #ced4da !important;
    }

    .trix-active {
        background-color: #ced4da !important;
    }

    trix-editor {
        border-color: #ced4da !important;
        min-height: 150px;
    }

    trix-editor.is-invalid {
        border-color: #ef5350 !important;
    }
</style>
