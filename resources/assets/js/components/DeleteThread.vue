<template>
    <div>
        <form ref="deleteThread" @submit.prevent="onSubmit" method="POST" :action="formAction">
            <input type="hidden" name="_token" :value="app.csrfToken">
            <input type="hidden" name="_method" value="DELETE">

            <button type="submit" class="action-link ml-2">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['formAction'],

        methods: {
            onSubmit() {
                swal({
                    buttons: ['Não', 'Sim, apague'],
                    icon: 'warning',
                    dangerMode: true,
                    title: 'Você tem certeza?',
                    text: 'Isso irá apagar o tópico e todos os comentários.'
                }).then(yes => {
                    if (! yes) {
                        return;
                    }

                    this.$refs.deleteThread.submit();
                });
            }
        }
    }
</script>
