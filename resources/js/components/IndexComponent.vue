<template>
    <div class="navMenu p-3 mt-1 flex flex-row justify-around" id="upperDiv">

        <div class="firstDiv ml-5 flex flex-row">
            <img src="logo.png">
            <span class="ml-3 text-2xl">Ministerul Finanțelor</span>
            <img src="ader.jpg">
        </div>

        <div class="flex flex-row miniLinks">
            <a href="#">Acasă</a>
            <span class="ml-2 mr-2">|</span>
            <a href="#">Contacte</a>
        </div>

        <div class="flex flex-row gap-3 allFlags">
            <img class="flags cursor-pointer" src="flagMD.png">
            <img class="flags cursor-pointer" src="russia.png">
            <img class="flags cursor-pointer" src="uk.png">
        </div>
    </div>

    <nav-links></nav-links>
    <search-component></search-component>
    <div class="bg-white">

    <router-link :to="{name:'Main'}">Main</router-link>
    <router-link :to="{name:'About'}">About</router-link>
    </div>
    <router-view></router-view>
</template>

<script>
import NavLinks from "./NavLinks.vue";
import SearchComponent from "./searchComponent.vue";
export default {
    name: "IndexComponent",
    components: {SearchComponent, NavLinks}
}
</script>

<style lang="scss" scoped>
#upperDiv{
    background-color:white;
}
.flags{
    width:25px;
    height:20px;
    position:relative;
    top:2vw;
    &:active{
        transform:translateY(2px);
    }
}
.firstDiv{
    align-items: center;
}
.miniLinks{
    color:#005FB9;
    position:relative;
    left:10vw;
}
@media (max-width: 755px) {
    .allFlags {
        display: flex;
        position:relative;
        top:50px;
        right:50px;

    }
    .miniLinks{
        margin-right:30px;
        position:relative;
        bottom:10px;

    }
}


</style>
