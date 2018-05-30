<template>
    <div class="card my-3">
        <div class="card-body">
            <div class="mb-0 d-flex justify-content-between align-items-center" :class="{ 'mb-2': editing }">
                <div>
                    <a href="#" class="font-weight-bold">{{ reply.user.username }}</a>
                    <span class="text-muted">em {{ ago }}:</span>
                </div>

                <favorite-button v-if="app.signedIn"
                                 :model="reply"
                                 :favorited="reply.favoritedByUser"
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

        <div v-if="userOwns(reply)" class="card-footer custom-card-footer d-flex justify-content-end">
            <button @click="editing = true" class="action-link">
                <i class="fa fa-pencil"></i>
            </button>

            <button @click="destroy" class="action-link ml-2">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import swal from 'sweetalert';

    export default {
        props: ['reply'],

        data() {
            return {
                editing: false,
                body: this.reply.body
            };
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.reply.id, {
                    body: this.body
                }).then(response => {
                    this.editing = false;

                    toastr.success('Comentário atualizado.');
                }).catch(error => {
                    toastr.error('O comentário não pode ser vazio.');
                });
            },

            destroy() {
                swal({
                    buttons: ['Não', 'Sim'],
                    dangerMode: true,
                    icon: 'warning',
                    title: 'Você tem certeza?'
                }).then(yes => {
                    if (! yes) {
                        return;
                    }

                    axios.delete('/replies/' + this.reply.id).then(response => {
                        this.$emit('deleted');

                        toastr.success('Comentário removido.');
                    });
                });
            }
        },

        computed: {
            ago() {
                moment.locale('pt-BR');

                return moment(this.reply.created_at).format('LL');
            }
        }
    }
</script>
