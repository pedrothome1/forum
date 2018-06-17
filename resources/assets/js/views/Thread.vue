<script>
    import BestReply from '../components/BestReply';
    import DeleteThread from '../components/DeleteThread';

    export default {
        props: ['thread', 'bestReply'],

        components: { BestReply, DeleteThread },

        data() {
            return {
                page: 1,
                show: false,
                best: this.bestReply,
                solved: this.thread.solved
            };
        },

        created() {
            window.events.$on('new-page', page => this.page = page);

            window.events.$on('solved', bestReply => {
                this.solved = true;
                this.best = bestReply;
            });
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
