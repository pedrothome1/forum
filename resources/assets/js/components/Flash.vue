<template></template>

<script>
    export default {
        props: ['type', 'message'],

        created() {
            if (this.message) {
                window.toastr[this.type](this.message);
            }
        }
    }
</script>
