<template>
    <div v-if="app.signedIn" class="my-3">
        <div class="form-group">
            <text-editor v-model="body"
                         placeholder="O que você achou dessa postagem?"
                         :clear="changed"
                         :error="error"
                         @keydown="error = ''"></text-editor>
        </div>

        <div class="form-group">
            <button @click="addReply" class="btn btn-primary">
                <span v-show="isLoading"><i class="fa fa-spinner fa-spin"></i>&nbsp;</span>Responder
            </button>
        </div>
    </div>

    <div v-else>
        <div class="alert alert-warning my-3">
            Você precisa estar autenticado para responder: <a @click.prevent="$modal.show('login')" href="#">Entrar</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: '',
                error: '',
                changed: false,
                isLoading: false
            };
        },

        methods: {
            addReply() {
                this.isLoading = true;

                axios.post(location.pathname + '/replies', {
                    reply_body: this.body
                }).then(({data}) => {
                    this.$emit('created', data);

                    this.body = '';
                    this.changed = ! this.changed;

                    toastr.success('Comentário postado.');

                    this.isLoading = false;
                }).catch(error => {
                    this.error = error.response.data.errors.reply_body[0];

                    this.isLoading = false;
                });
            }
        }
    }
</script>
