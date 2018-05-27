<template>
    <button class="favorite-link">
        <i :class="'fa fa-'+icon"></i>
    </button>
</template>

<script>
    export default {
        props: ['favorited', 'icon']
    }
</script>
