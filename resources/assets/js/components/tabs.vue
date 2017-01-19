<template>
    <div>
        <div class="tabs">
            <ul>
                <li v-for="tab in tabs" @click="selectedTab(tab)" :class="{ 'is-active' : tab.isActive }">
                    <a href="#">{{ tab.name }}</a>
                </li>
            </ul>
        </div>
        <div class="tabs-details">
            <slot></slot>
        </div>
    </div>

</template>

<script>
    export default{
    props : {
     selected : { default : false }
    },
    mounted() {
        console.log('tabs mounted');
    },
    created() {
        this.tabs = this.$children;
    },
    data(){
        return{
            msg:'hello vue',
            tabs : []
        }
    },
    methods : {
        selectedTab (currentTab) {
        console.log('from inside the selected tab');
        console.log(currentTab.name);
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == currentTab.name);
            });
        }
    },
    computed ()  {

    }
}




</script>
