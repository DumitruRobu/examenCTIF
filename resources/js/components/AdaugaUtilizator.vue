<template>
    <div class="flex flex-col gap-4 items-center justify-center">
        <input v-model="newUsersDetails.name" class="w-[30%] outline-none rounded p-2" type="text"
               placeholder="nume utilizator">

        <input v-model="newUsersDetails.email" class="w-[30%] outline-none rounded p-2" type="email"
               placeholder="email utilizator">

        <div class="password-container w-[30%]">
            <input v-model="newUsersDetails.password" class="w-[100%] outline-none rounded p-2"
                   :type="password_visible['password'] ? 'text':'password'"
                   placeholder="parola utilizator">
            <button class="searchEye"
                @mousedown="password_visible['password']=true"
                @mouseup="password_visible['password']=false"
                @mouseleave="password_visible['password']=false"
                @touchstart="password_visible['password']=true"
                @touchend="password_visible['password']=false"
            ><i class="fa-solid fa-eye"></i></button>
        </div>

        <div class="password-container w-[30%]">
            <input v-model="newUsersDetails.password_confirmed" class="w-[100%] outline-none rounded p-2"
                   :type="password_visible['confirm_password'] ? 'text':'password'"
                   placeholder="confirma parola utilizator">
            <button class="searchEye"
                    @mousedown="password_visible['confirm_password']=true"
                    @mouseup="password_visible['confirm_password']=false"
                    @mouseleave="password_visible['confirm_password']=false"
                    @touchstart="password_visible['confirm_password']=true"
                    @touchend="password_visible['confirm_password']=false"
            ><i class="fa-solid fa-eye"></i></button>
        </div>


        <select v-model="newUsersDetails.role" class="w-[30%] outline-none rounded p-2">
            <option value="null" disabled>-- Selecteaza rolul utilizatorului</option>
            <option v-for="rol in roluri" :value="rol.id">{{ rol.title }}</option>
        </select>

        <div v-if="newUsersDetails.role === 3" class="w-[30%]">
            <select v-model="newUsersDetails.raion_id" class="w-[100%] outline-none rounded p-2">
                <option value="null" disabled>-- Selecteaza raionul de operare al utilizatorului</option>
                <option v-for="raion in raioane" :value="raion.id">{{ raion.code }} -- {{ raion.name }}</option>
            </select>
        </div>


        <div class="flex gap-4">
            <router-link
                class="bg-transparent text-white hover:bg-white hover:text-[#1A3150] p-2 rounded border border-white"
                :to="{name:'AdminMenu'}">
                Inapoi
            </router-link>
            <button
                class="bg-transparent text-white hover:bg-white hover:text-[#1A3150] p-2 rounded border border-white"
                @click.prevent="creazaUtilizator">Creaza
            </button>
        </div>
    </div>
</template>

<script>
import api from '../api';
import router from "../router";

export default {
    name: "AdaugaUtilizator",
    data() {
        return {
            newUsersDetails: {
                name: null,
                email: null,
                password: null,
                password_confirmed: null,
                role: null,
                raion_id: null,
            },
            roluri: null,
            raioane: null,

            password_visible:{
                password:null,
                confirm_password:null,
            }
        }
    },
    mounted() {
        this.getAllInfo()
    },
    methods: {
        getAllInfo() {
            api.get('/api/auth/getInfo').then(res => {
                this.roluri = res.data.roles;
                this.raioane = res.data.raioane;
            })
        },
        creazaUtilizator(){
            api.post('/api/auth/createNewUser', {
                'name':this.newUsersDetails.name,
                'email':this.newUsersDetails.email,
                'password':this.newUsersDetails.password,
                'password_confirmation':this.newUsersDetails.password_confirmed,
                'role':this.newUsersDetails.role,
                'raion_id':this.newUsersDetails.raion_id,
            }).then(res =>{
                console.log(res);
                router.push({'name':'AdminMenu'});
            })
        }
    }

}
</script>

<style lang="scss" scoped>
.password-container{
    position:relative;
}
.searchEye {
    position: absolute;
    right:1%;
    top:15%;
}
</style>
