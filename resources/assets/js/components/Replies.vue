<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @deleted="remove(index)"></reply>
        </div>

        <div>
            <paginator :data-set="serverData" @new-page="fetch"></paginator>
        </div>

        <div>
            <new-reply @created="add"></new-reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply';
    import NewReply from './NewReply';
    import Paginator from './Paginator';
    import collection from '../mixins/collection';

    export default {
        components: { Reply, NewReply, Paginator },

        mixins: [collection],

        data() {
            return { serverData: false };
        },

        methods: {
            fetch(page) {
                axios.get(this.endpoint(page)).then(({data}) => {
                    this.items = data.data;
                    this.serverData = data;

                    window.scrollTo(0, 0);
                });
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
            this.fetch();
        }
    }
</script>
