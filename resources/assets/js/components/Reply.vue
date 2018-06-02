<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-0 d-flex justify-content-between align-items-center" :class="{ 'mb-2': editing }">
                <div>
                    <a href="#" class="font-weight-bold">{{ reply.user.username }}</a>
                    <span class="text-muted">{{ reply.ago }}:</span>
                </div>

                <favorite-button v-if="app.signedIn"
                                 :model="reply"
                                 icon="thumbs-up"
                                 :show-count="true">
                </favorite-button>
            </div>

            <div v-if="editing">
                <text-editor v-model="body"></text-editor>

                <div class="mt-2">
                    <button @click="update" class="btn btn-primary btn-sm">Salvar</button>
                    <button @click="editing = false" class="btn btn-light btn-sm">Cancelar</button>
                </div>
            </div>

            <p v-else class="mb-0" v-html="body"></p>
        </div>

        <div v-if="! threadSolved && (userOwns(reply) || userOwns(reply.thread))" class="card-footer custom-card-footer d-flex justify-content-between">
            <div v-if="userOwns(reply)">
                <button @click="editing = true" class="action-link">
                    <i class="fa fa-pencil"></i>
                </button>

                <button @click="destroy" class="action-link ml-2">
                    <i class="fa fa-trash"></i>
                </button>
            </div>

            <div v-if="userOwns(reply.thread)">
                <button @click="markAsBest" class="action-link">
                    <small><i class="fa fa-check"></i> Melhor resposta?</small>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: ['reply', 'threadSolved'],

        data() {
            return {
                editing: false,
                body: this.reply.body,
                oldBody: this.reply.body
            };
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.reply.id, {
                    body: this.body
                }).then(response => {
                    this.oldBody = this.body;
                    this.editing = false;

                    toastr.success('Comentário atualizado.');
                }).catch(error => {
                    toastr.error('O comentário não pode ser vazio.');
                });
            },

            destroy() {
                swal({
                    buttons: ['Não', 'Sim, apague'],
                    icon: 'warning',
                    dangerMode: true,
                    title: 'Você tem certeza?',
                    text: 'Isso irá apagar seu comentário.'
                }).then(yes => {
                    if (! yes) {
                        return;
                    }

                    axios.delete('/replies/' + this.reply.id).then(response => {
                        this.$emit('deleted');

                        toastr.success('Comentário removido.');
                    });
                });
            },

            markAsBest() {
                swal({
                    buttons: ['Não', 'Sim'],
                    icon: 'warning',
                    title: 'Você tem certeza?',
                    text: 'Isso irá marcar o tópico como resolvido. Se sua dúvida persistir, terá que criar outro!'
                }).then(yes => {
                    if (! yes) {
                        return;
                    }

                    axios.post('/replies/' + this.reply.id + '/best')
                        .then(response => {
                            window.events.$emit('solved', this.reply);
                        });
                });
            }
        },

        watch: {
            editing(newValue, oldValue) {
                if (! newValue) {
                    this.body = this.oldBody;
                }
            }
        }
    }
</script>
