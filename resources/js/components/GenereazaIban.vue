<template>
    <div class="flex flex-col mt-4">
        <input
            v-model="theCode"
            @input="checkCode"
            class="w-[30%] p-2 rounded mx-auto focus:outline-none"
            type="text"
            maxlength="24">
        <div class="flex gap-1 ml-[35%] mt-1">
            <img v-if="errors.lungimeaSirului" class="w-5 " src="../../../public/loading.gif" alt="loadingIcon">
            <img v-else class="w-5" src="../../../public/checked.png" alt="checkedIcon">
            <span class="text-white">Codul trebuie să conțină strict 24 caractere!</span>
        </div>

        <div class="flex gap-1 ml-[35%] mt-1">
            <img v-if="!errors.last14Digits" class="w-5" src="../../../public/loading.gif" alt="loadingIcon">
            <img v-else class="w-5" src="../../../public/checked.png" alt="checkedIcon">
            <span class="text-white">Ultimele 14 caractere trebuie să fie cifre!</span>
        </div>

        <button @click.prevent="verifyDisponibilitate" class="mx-auto p-1 rounded border border-1 bg-white text-[#1A3150] w-[15%]" v-if="errors.last14Digits && !errors.lungimeaSirului">Verifica disponibilitate iban!</button>
            <span class="mt-4 mx-auto text-white" v-if="raspuns">{{raspuns}}</span>
            <div v-if="checkCodeTriggered && !raspuns" class="mt-4 mx-auto text-white flex">
                <img  class="w-5 " src="../../../public/loading.gif" alt="loadingIcon"> Loading...
            </div>
    </div>
</template>

<script>
import api from '../api';
export default {
    name: "GenereazaIban",
    data(){
        return{
            theCode:"MD",
            checkCodeTriggered:false,
            raspuns:null,
            errors:{
                lungimeaSirului:true,
                last14Digits:false,
            }
        }
    },
    methods:{
        checkCode(){

            this.theCode = this.theCode.toUpperCase();

            this.raspuns = null;
            this.checkCodeTriggered = false;

            if (!this.theCode.startsWith("MD")) {
                this.theCode = "MD" + this.theCode.slice(1);
            }
            this.errors.lungimeaSirului = this.theCode.length !== 24;
            this.errors.last14Digits = !isNaN(this.theCode.slice(10)) && this.theCode.length === 24;

        },
        showCode(){
            console.log(this.theCode);
            console.log("Last 14 digits? " + this.errors.last14Digits);
        },
        verifyDisponibilitate(){
            this.checkCodeTriggered = true;
            api.post('/api/auth/verificaDisponibilitate', {'cod':this.theCode}).then(res =>{
                console.log(res.data.data);
                this.raspuns = res.data.message;
                this.checkCodeTriggered = false;
            })
        }

    }
}
</script>

<style scoped>

</style>
