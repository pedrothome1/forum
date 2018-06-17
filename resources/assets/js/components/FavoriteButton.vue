<template>
    <button type="button"
            :disabled="sendingRequest"
            @click="toggleFavorite"
            class="favorite-link"
            :class="{ 'text-orange': active }">
        <i :class="'fa fa-'+icon"></i>{{ favoritesCount }}
    </button>
</template>

<script>
    export default {
        props: {
            model: Object,
            icon: String,
            showCount: { type: Boolean, default: false }
        },

        data() {
            return {
                active: false,
                sendingRequest: false,
                count: this.model.favorites_count || 0
            };
        },

        methods: {
            toggleFavorite() {
                this.sendingRequest = true;

                this.active = ! this.active;
                this.active ? this.count++ : this.count--;

                if (this.isThread) {
                    this.flashMessage();
                }

                axios.post(this.endpoint).then(response => {
                    this.sendingRequest = false;
                });
            },

            flashMessage() {
                if (this.active) {
                    toastr.success('Adicionado aos favoritos.');

                    return;
                }

                toastr.success('Removido dos favoritos.');
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
            },

            isThread() {
                return this.model.identifier === 'slug';
            }
        },

        created() {
            this.active = !! this.model.favoritedByUser;
        }
    }
</script>
