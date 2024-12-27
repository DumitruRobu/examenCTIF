<template>
    <div class="flex flex-col gap-3 items-center">
        <select @change="addTheSelectedEco" v-model="eco_codul_selectat" class="p-2 focus:outline-none rounded w-[15%]">
            <option :value="null" disabled selected>Codul eco</option>
            <option v-for="eco in ecos" :value="eco.codul">{{eco.codul}}</option>
        </select>

        <select v-model="raionul_selectat" @change="updateLocalities" class="p-2 focus:outline-none rounded w-[15%]">
            <option :value="null" disabled selected>Raion</option>
            <option v-for="raion in raions" :value="raion.code" :key="raion.code">{{raion.code + ' -- ' + raion.name}}</option>
        </select>

        <select v-if="raionul_selectat" v-model="localitatea_selectata" class="p-2 focus:outline-none rounded w-[15%]">
            <option :value="null" disabled selected>--Alege localitate</option>
            <option v-for="localitate in localitati">{{localitate.code + " " + localitate.name}}</option>
        </select>

        <input @input="checkCode" v-model="theCode" class="p-2 focus:outline-none rounded w-[15%]" type="text" placeholder="Cod Iban">

        <div class="flex gap-2">
            <button>
                <router-link :to="{name:'AdminMenu'}">Inapoi</router-link>
            </button>
            <button>Creaza</button>
        </div>

    </div>

</template>

<script>
import api from '../api';
export default {
    name: "CreazaCodIban",
    data(){
        return{
            ecos:null,
            raions:null,
            localitati:null,
            eco_codul_selectat:null,
            raionul_selectat:null,
            localitatea_selectata:null,
            theCode:"MD12TRGAAA",
        }
    },
    mounted(){
        this.getInfoForIbans()
    },
    methods:{
        addTheSelectedEco() {
            this.theCode += this.eco_codul_selectat;
        },

        getInfoForIbans(){
            api.get('/api/auth/getInfoForIbans').then(res =>{
                this.ecos = res.data.eco;
                this.raions = res.data.raions;
            })
        },
        updateLocalities(event) {
            this.theCode += this.raionul_selectat;
            api.get(`/api/auth/updateLocalities/${event.target.value}`).then(res => {
                this.localitati = res.data.localities.map(localitate => ({
                    name: localitate.name,
                    code: localitate.codul,
                }))

            });
        },
        checkCode(){
            if (!this.theCode.startsWith("MD")) {
                this.theCode = "MD" + this.theCode.slice(1);
            }
        }
    }
}
</script>

<style scoped>
button{
    border:1px solid white;
    color:white;
    padding:5px;
    border-radius: 5px;
}
</style>
