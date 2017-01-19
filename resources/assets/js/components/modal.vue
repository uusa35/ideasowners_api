<template>
    <div>
        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <slot></slot>
                </div>
            </div>
            <button class="modal-close" @click="$emit('close')">x</button>
        </div>
    </div>
</template>
<style>
    body{
        background-color:white;
    }
</style>
<script>
    export default{
        data(){
            return{
                msg:' testing testing testing testing testing testing '
            }
        }
    }

</script>
