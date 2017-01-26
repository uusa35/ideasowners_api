<template>
    <article class="message" v-show="isVis">
        <div class="message-header">
            <p>{{ title }}</p>
            <button class="delete" @click="hideElement"></button>
        </div>
        <div class="message-body">
            {{ body }}
        </div>
    </article>
</template>

<script>
    export default{
        props : ['title','body'],

        data () {
            return {
                isVis : true,
            }
        },

        methods : {
            hideElement() {
                this.isVis = false;
            }
        }
    }


</script>
