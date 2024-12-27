<template>
    <div class="mt-[2%] mb-[2%] flex flex-col w-[20%] m-auto gap-4 " v-if="new_users_info">
        <input class="rounded p-2" v-model="new_users_info.name" type="text" placeholder="name">
        <input class="rounded p-2" v-model="new_users_info.email" type="text" placeholder="email">
        <input class="rounded p-2" v-model="new_users_info.password" type="text" placeholder="reset password">

        <select class="rounded p-2" v-model="new_users_info.imputernicire_id">
            <option :value="null" disabled>--Selecteaza rol</option>
            <option v-for="imputernicire in imputerniciri" :value="imputernicire.id">
                {{imputernicire.id}}. {{imputernicire.title}}
            </option>
        </select>

<!--        <input class="rounded p-2" v-if="new_users_info.raion" v-model="new_users_info.raion.name" type="text" placeholder="raion operare">-->
        <div v-if="new_users_info.imputernicire_id === 3">
            <select class="rounded p-2" v-model="new_users_info.raion_id">
                <option :value="null" disabled>--Selecteaza raion</option>
                <option v-for="raion in raioane" :value="raion.id">{{raion.code}} - {{raion.name}}</option>
            </select>
        </div>


        <div class="flex m-auto gap-4 text-white">
            <button @click.prevent="editUser" class="rounded p-2 border-2">Editează</button>
            <button class="rounded p-2 border-2">
                <router-link :to="{name:'AdminMenu'}">Înapoi</router-link>
            </button>
        </div>
    </div>
</template>

<script>
import api from '../api';
import router from "../router";

export default {
    name: "EditUsersPage",
    data(){
        return {
            new_users_info:{
                name:null,
                email:null,
                raion_id:null,
                password:null,
                imputernicire_id:null,
            },
            raioane:null,
            imputerniciri:null,
        }
    },
    mounted() {
        this.getUser()
    },
    methods:{
        getUser(){
            api.get(`/api/auth/getEditedUser/${this.$route.params.id}`).then(res =>{
                // console.log(res.data.user);
                // if(res.data.user_raion){console.log(res.data.user_raion.id)}
                // console.log(res.data);
                // if(res.data.user_imputernicire)
                //     {
                //         console.log(res.data.user_imputernicire[0].id);
                //     }
                this.new_users_info.name = res.data.user.name;
                this.new_users_info.email = res.data.user.email;
                this.new_users_info.password = res.data.password;

                if(res.data.user_raion){this.new_users_info.raion_id = res.data.user_raion.id;}

                console.log(res.data.user_imputernicire);
                if(res.data.user_imputernicire && res.data.user_imputernicire.length > 0)
                    {
                        this.new_users_info.imputernicire_id = res.data.user_imputernicire[0].id
                    }

                this.raioane = res.data.raions;
                this.imputerniciri = res.data.imputerniciri;
            })
        },
        editUser(){
            console.log("Aici intram!");
            api.post(`/api/auth/editUser/${this.$route.params.id}`,
                {
                    'name':this.new_users_info.name,
                    'email':this.new_users_info.email,
                    'password':this.new_users_info.password,
                    'rol':this.new_users_info.imputernicire_id,
                    'raion_id':this.new_users_info.raion_id,
                }).then(res =>{
                    console.log(res);
                    router.push({name:'AdminMenu'});
            })
        },
    },
}

</script>

<style lang="scss" scoped>
button:hover{
    color:#1A3150;
    background-color: white;
}
</style>
