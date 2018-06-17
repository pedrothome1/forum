<template>
    <div>
        <div class="card my-3 border-success">
            <div class="card-header bg-success text-white font-weight-bold">
                <i class="fa fa-check"></i> Solução
            </div>

            <div class="card-body">
                <div class="mb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <a :href="'/profiles/'+reply.user.username" class="font-weight-bold">{{ reply.user.username }}</a>
                        <span class="text-muted">{{ reply.ago }}:</span>
                    </div>
                </div>

                <p class="mb-0" v-html="reply.body"></p>
            </div>
        </div>

        <hr>
    </div>
</template>

<script>
    export default {
        props: ['reply']
    }
</script>
