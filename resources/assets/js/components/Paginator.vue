<template>
    <nav v-if="!! previousUrl || !! nextUrl">
        <ul class="pagination">
            <li class="page-item">
                <a :disabled="previousUrl" @click.prevent="page--" class="page-link" href="#">
                    &laquo; Anterior
                </a>
            </li>

            <li class="page-item">
                <a :disabled="nextUrl" @click.prevent="page++" class="page-link" href="#">
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
                this.previousUrl = this.dataSet.prev_page_ur;
            },

            page() {
                this.$emit('new-page', this.page);
            }
        }
    }
</script>
