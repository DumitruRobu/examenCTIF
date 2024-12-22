<template>
    <div class="navMenu p-3 mt-1 flex flex-row justify-around" id="upperDiv">

        <div class="firstDiv ml-5 flex flex-row">
            <img src="logo.png">
            <span class="ml-3 text-2xl">Ministerul Finanțelor</span>
            <img src="ader.jpg">
        </div>

        <div class="flex flex-col miniLinks">

            <div>
                <a href="#" class="h-[25px]">Acasă</a>
                <span class="ml-2 mr-2">|</span>
                <a href="#" class="h-[25px]">Contacte</a>
                <span class="ml-2 mr-2">|</span>

                <template v-if="!access_token">
                    <router-link :to="{name:'Login'}">Login</router-link>
                    <span class="ml-2 mr-2">|</span>
                    <router-link :to="{name:'Register'}">Register</router-link>
                </template>

                <span v-if="access_token">
                <button class="inline-block" @click.prevent="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </span>
            </div>

            <div class="userInfo" v-if="utilizator_nume && utilizator_rol" >
                <span>Welcome {{utilizator_nume}}, {{utilizator_rol}}</span>
            </div>

        </div>

        <div class="flex flex-row gap-3 allFlags">
            <img class="flags cursor-pointer" src="flagMD.png">
            <img class="flags cursor-pointer" src="russia.png">
            <img class="flags cursor-pointer" src="uk.png">
        </div>

    </div>

    <nav-links :shared_access_token="access_token" :users_role="utilizator_rol"></nav-links>
<!--    <div class="Links">-->
<!--        <router-link v-if="!access_token" :to="{name:'Login'}">Login</router-link>-->
<!--        <router-link v-if="!access_token" :to="{name:'Register'}">Register</router-link>-->
<!--        <router-link v-if="access_token" :to="{name:'SearchIban'}">Search Iban</router-link>-->
<!--    </div>-->

    <router-view :key="$route.fullPath"></router-view>

<!--    <search-component></search-component>-->

</template>

<script>
import NavLinks from "./NavLinks.vue";
import SearchComponent from "./searchComponent.vue";
import api from '../api'
import router from "../router";

export default {
    name: "IndexComponent",
    components: {SearchComponent, NavLinks},


    data(){
        return{
            access_token:null,
            utilizator_nume:null,
            utilizator_rol:null,
            raionul_utilizatorului:null,

        }
    },
    watch:{
        access_token(newToken){
            if(newToken){
                this.getUser();
            }
        }
    },
    mounted(){
        this.getAccessToken()
    },
    methods:{
        getAccessToken(){
            if(localStorage.getItem('access_token')){
                this.access_token = localStorage.getItem('access_token');
            }
        },
        getUser(){
            if(this.access_token){
                api.get('/api/auth/getUser').then(res =>{
                   this.utilizator_nume = res.data.user.name;
                   if(res.data.role[0]){
                       this.utilizator_rol = res.data.role[0].title;
                   }
                   else{this.utilizator_rol = "user";}
                   // console.log("Rol: "+this.utilizator_rol);
                   // console.log("Nume: "+this.utilizator_nume);
                   if(res.data.user.raion_id){
                       // console.log("Raion id: "+res.data.user.raion_id);
                       this.raionul_utilizatorului = res.data.user.raion_id;
                   }
                })
            }
        },
        logout() {
            api.post('/api/auth/logout').then(res => {
                console.log('Logged out!');
                localStorage.removeItem('access_token');
                this.access_token = null
                this.utilizator_nume=null
                this.utilizator_rol=null
                router.push({name: 'Login'});
            })

        },
    },
    updated(){
        this.getAccessToken();
    }
}
</script>

<style lang="scss" scoped>
#upperDiv {
    background-color: white;
}

.flags {
    width: 25px;
    height: 20px;
    position: relative;
    top: 2vw;

    &:active {
        transform: translateY(2px);
    }
}

.firstDiv {
    align-items: center;
}

.miniLinks {
    color: #005FB9;
    position: relative;
    left: 5vw;
}

@media (max-width: 755px) {
    .allFlags {
        display: flex;
        position: relative;
        top: 50px;
        right: 50px;

    }
    .miniLinks {
        margin-right: 30px;
        position: relative;
        bottom: 10px;
    }
    .userInfo{
        display:none;
    }
}
.Links{
    display:flex;
    flex-direction: row;
    gap:10px;
    align-items: center;
    justify-content: center;
    background-color: white;
    color:black;
}


</style>
