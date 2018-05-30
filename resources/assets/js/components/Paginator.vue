<template>
    <nav v-if="previousUrl || nextUrl">
        <ul class="pagination">
            <li class="page-item" :class="{ 'disabled': ! previousUrl }">
                <a @click.prevent="page--" class="page-link" href="#">
                    &laquo; Anterior
                </a>
            </li>

            <li class="page-item" :class="{ 'disabled': ! nextUrl }">
                <a @click.prevent="page++" class="page-link" href="#">
                    Próximo &raquo;
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: this.dataSet.current_page,
                nextUrl: this.dataSet.next_page_url,
                previousUrl: this.dataSet.prev_page_url
            };
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.nextUrl = this.dataSet.next_page_url;
                this.previousUrl = this.dataSet.prev_page_url;
            },

            page() {
                history.pushState(null, null, '?page=' + this.page);

                this.$emit('new-page', this.page);
            }
        }
    }
</script>
