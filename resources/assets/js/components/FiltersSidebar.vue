<template>
    <div class="card">
        <div class="card-header" :class="{ 'border-bottom-0': filtersTab }">
            <ul class="nav nav-tabs card-header-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" @click.prevent="filtersClicked" :class="{ 'active': filtersTab }" href="#">
                        Filtros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" @click.prevent="categoriesClicked" :class="{ 'active': categoriesTab }" href="#">
                        Assuntos
                    </a>
                </li>
            </ul>
        </div>

        <ul v-show="categoriesTab" class="list-group list-group-flush">
            <a v-for="category in categories"
               :key="category.id"
               :href="`/${category.slug}`"
               class="list-group-item list-group-item-action">
                <i class="fa fa-comments-o text-info"></i> {{ category.name }}
            </a>
        </ul>

        <ul v-show="filtersTab" class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action">
                <i class="fa fa-globe text-danger"></i> Todo os tópicos
            </a>

            <template v-if="app.signedIn">
                <a href="/?my=1" class="list-group-item list-group-item-action">
                    <i class="fa fa-lightbulb-o text-danger"></i> Meus tópicos
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa fa-code-fork text-danger"></i> Minhas participações
                </a>

                <a href="/?favorite=1" class="list-group-item list-group-item-action">
                    <i class="fa fa-star text-danger"></i> Meus favoritos
                </a>
            </template>

            <a href="/?popular=1" class="list-group-item list-group-item-action">
                <i class="fa fa-fire text-danger"></i> Mais populares
            </a>

            <a href="/?solved=1" class="list-group-item list-group-item-action">
                <i class="fa fa-fire text-danger"></i> Solucionados
            </a>

            <a href="/?unsolved=1" class="list-group-item list-group-item-action">
                <i class="fa fa-lightbulb-o text-danger"></i> Não solucionados
            </a>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['categories'],

        data() {
            return {
                filtersTab: true,
                categoriesTab: false
            };
        },

        methods: {
            filtersClicked() {
                this.filtersTab = true;
                this.categoriesTab = false;
            },

            categoriesClicked() {
                this.filtersTab = false;
                this.categoriesTab = true;
            }
        }
    }
</script>
