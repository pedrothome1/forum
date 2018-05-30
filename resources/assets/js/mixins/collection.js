export default {
    data() {
        return {
            items: []
        }
    },

    methods: {
        add(item) {
            this.items.push(item);

            return this.$emit('added', item);
        },

        remove(index) {
            return this.$emit('removed', this.items.splice(index, 1)[0]);
        }
    }
}
