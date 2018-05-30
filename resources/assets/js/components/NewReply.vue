<template>
    <div v-if="app.signedIn" class="my-3">
        <div class="form-group">
            <text-editor v-model="body" placeholder="O que você achou dessa postagem?" :clear="changed"></text-editor>
        </div>

        <div class="form-group">
            <button @click="addReply" class="btn btn-primary">
                Responder
            </button>
        </div>
    </div>

    <div v-else>
        <p class="text-center my-3">
            Você precisa estar autenticado para responder: <a href="/login">Entrar</a>
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
                changed: false
            };
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {
                    body: this.body
                }).then(({data}) => {
                    this.$emit('created', data);

                    this.body = '';
                    this.changed = ! this.changed;

                    toastr.success('Comentário postado.');
                }).catch(error => {
                    console.log(error.response.data);
                });
            }
        }
    }
</script>
