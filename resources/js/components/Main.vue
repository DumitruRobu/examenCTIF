<template>
    <div class="mainDiv">
        <p v-if="!this.$parent.$parent.access_token">Bine a-ti venit pe platforma de căutare a codurilor
            iban a Ministerului Finanțelor. Pentru a putea beneficia de acest
            serviciu, va rugam să vă
            <router-link class="underline underline-offset-4" :to="{name:'Login'}">logați</router-link>
            sau
            <router-link class="underline underline-offset-4" :to="{name:'Register'}">înregistrați.</router-link>
        </p>

        <p v-else>Sunteti logat cu succes. Pentru a vedea lista codurilor iban, accesati
            <router-link class="underline underline-offset-4" :to="{name:'SearchIban'}"> aici!</router-link>
        </p>
    </div>
</template>

<script>
export default {
    name: "Main",
    mounted() {
        this.showAccToken()
    },
    methods:{
        showAccToken(){
            console.log(this.$parent.$parent.access_token);
        }
    }
}
</script>

<style scoped>
    .mainDiv{
        /*position: absolute;*/
        /*top: 50%;*/
        /*left: 50%;*/
        /*transform: translate( -50%, -50%);*/

        width:30%;
        margin:10% auto;


        text-align: center;
        color:white;
        font-size:20px;
        border:1px solid lightgray;
        padding:40px;
        background-color: rgb(29, 57, 95);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

</style>
