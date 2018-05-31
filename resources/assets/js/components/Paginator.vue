<template>
    <nav v-if="previousUrl || nextUrl">
        <ul class="pagination">
            <li class="page-item" :class="{ 'disabled': changing || ! previousUrl }">
                <a @click.prevent="page += page > 1 ? -1 : 0" class="page-link" href="#">
                    &laquo; Anterior
                </a>
            </li>

            <li class="page-item" :class="{ 'disabled': changing || ! nextUrl }">
                <a @click.prevent="page += page < lastPage ? 1 : 0" class="page-link" href="#">
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
                lastPage: this.dataSet.last_page,
                nextUrl: this.dataSet.next_page_url,
                previousUrl: this.dataSet.prev_page_url,

                changing: false
            };
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.lastPage = this.dataSet.last_page;
                this.nextUrl = this.dataSet.next_page_url;
                this.previousUrl = this.dataSet.prev_page_url;

                this.changing = false;
            },

            page() {
                this.changing = true;

                history.replaceState(null, null, '?page=' + this.page);

                this.$emit('new-page', this.page);
            }
        }
    }
</script>
