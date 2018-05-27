<template>
    <button type="button"
            :disabled="sendingRequest"
            @click="toggleFavorite"
            class="favorite-link"
            :class="{ 'text-danger': active }">
        <i :class="'fa fa-'+icon"></i>{{ favoritesCount }}
    </button>
</template>

<script>
    export default {
        props: {
            model: Object,
            icon: String,
            showCount: { type: Boolean, default: false },
            favorited: { type: Number, required: true }
        },

        data() {
            return {
                active: false,
                sendingRequest: false,
                count: this.model.favorites_count
            };
        },

        methods: {
            toggleFavorite() {
                this.sendingRequest = true;

                this.active = ! this.active;
                this.active ? this.count++ : this.count--;

                axios.post(this.endpoint).then(response => {
                    this.sendingRequest = false;
                });
            }
        },

        computed: {
            favoritesCount() {
                if (this.showCount && this.count > 0) {
                    return ' ' + this.count;
                }

                return '';
            },

            endpoint() {
                return '/favorites/' + this.model[this.model.identifier];
            }
        },

        created() {
            this.active = !! this.favorited;
        }
    }
</script>
