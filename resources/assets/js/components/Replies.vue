<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" :thread-solved="threadSolved" @deleted="remove(index)"></reply>
        </div>

        <div>
            <paginator :data-set="serverData"></paginator>
        </div>

        <div v-if="! threadSolved">
            <new-reply @created="onCreation"></new-reply>
        </div>

        <div v-else class="alert alert-warning">
            Este tópico foi marcado como solucionado, se a dúvida ainda persiste, abra outro tópico.
        </div>
    </div>
</template>

<script>
    import Reply from './Reply';
    import NewReply from './NewReply';
    import collection from '../mixins/collection';

    export default {
        props: ['threadSolved'],

        components: { Reply, NewReply },

        mixins: [collection],

        data() {
            return {
                perPage: false,
                serverData: false
            };
        },

        methods: {
            refresh(page) {
                this.fetch(page).then(data => {
                    this.setData(data);

                    window.scrollTo(0, 0);
                });
            },

            onCreation(reply) {
                if (this.items.length < this.perPage) {
                    this.add(reply);

                    console.log('Otimizado!');

                    return;
                }

                this.fetch().then(data => {
                    this.setData(data);
                });
            },

            fetch(page) {
                return new Promise((resolve, reject) => {
                    axios.get(this.endpoint(page))
                        .then(response => {
                            resolve(response.data);
                        })
                        .catch(error => {
                            reject(error.response.data);
                        })
                });
            },

            setData(data) {
                this.items = data.data;
                this.serverData = data;

                this.perPage = this.serverData.per_page;
            },

            endpoint(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return location.pathname + '/replies?page=' + page;
            }
        },

        created() {
            window.events.$on('new-page', this.refresh);

            this.fetch().then(data => {
                this.setData(data);

                this.$emit('loaded');
            });
        }
    }
</script>
