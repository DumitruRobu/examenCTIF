<template>
    <div class="dropDownMenu">
        <button class="btnLink p-3 text-white">Despre Minister</button>
        <div class="links ">
            <a href="#">Conducerea</a>
            <a href="#">Audiența cetățenilor</a>
            <a href="#">Structura</a>
            <a href="#">Activitățile Ministerului</a>
            <a href="#">Bugetul Ministerului</a>
            <a href="#">Achiziții publice ale Ministerului</a>
            <a href="#">Cooperare internațională</a>
            <a href="#">Documente</a>
            <a href="#">Instituții subordonate</a>
            <a href="#">Scrieți ministerului</a>
            <a href="#">Anticorupția</a>
            <a href="#">Catalogul de Date Deschise al MF</a>
            <a href="#">Controale efectuate în cadrul MF</a>
            <a href="#">Deplasări de serviciu în străinătate</a>
            <a href="#">Petiții</a>
        </div>
    </div>

    <div class="dropDownMenu">
        <button class="btnLink p-3 hover:bg-emerald-800 text-white">Legislație</button>
        <div class="links">
            <a href="#">Buget și trezorerie</a>
            <a href="#">Datoria Sectorului public</a>
            <a href="#">Impozite și taxe</a>
            <a href="#">Contabilitate și Audit</a>
            <a href="#">Altele</a>
        </div>
    </div>

    <div class="dropDownMenu">
        <button class="btnLink p-3 hover:bg-emerald-800 text-white">Transparența decizională</button>
        <div class="links">
            <a href="#">Procesul decizional</a>
            <a href="#">Modulul de participare</a>
            <a href="#">Platforme consultative</a>
            <a href="#">Programe și raportare</a>
            <a href="#">Monitorizarea implementării</a>
        </div>
    </div>

    <div class="dropDownMenu">
        <button class="btnLink p-3 hover:bg-emerald-800 text-white">Media</button>
        <div class="links">
            <a href="#">Comunicate</a>
            <a href="#">Anunțuri</a>
            <a href="#">Galeria Foto</a>
            <a href="#">Galeria Video și audio</a>
            <a href="#">Calendar</a>
        </div>
    </div>

    <div class="dropDownMenu">
        <button class="btnLink p-3 hover:bg-emerald-800 text-white">Cariere</button>
        <div class="links">
            <a href="#">Posturi vacante</a>
            <a href="#">Lista candidaților admiși la concurs</a>
            <a href="#">Lista candidaților admiși la interviu</a>
            <a href="#">Lista candidaților înfingători ai concursului</a>
            <a href="#">Cariere.gov.md</a>
            <a href="#">Voluntariat</a>
            <a href="#">Stagiere</a>
            <a href="#">Instruire și dezvoltarea capacităților</a>
        </div>
    </div>




    <div class="dropDownMenu mt-[12px]">
<!--        <router-link-->
<!--            v-if="$parent.$parent.access_token"-->
<!--            :to="{name: 'SearchIban'}"-->
<!--            class="btnLink p-3 hover:bg-emerald-800 text-white"-->
<!--        >-->
<!--            Ibans-->
<!--        </router-link>-->

        <!-- Fix versiunea de mai sus doar ca cu props!-->
        <div class="links">

        </div>
        <router-link
            v-if="shared_access_token"
            :to="{name: 'SearchIban'}"
            class="btnLink p-3 hover:bg-emerald-800 text-white"
        >
            Ibans
        </router-link>

        <router-link
            v-if="shared_access_token && users_role === 'admin'"
            :to="{name: 'AdminMenu'}"
            class="btnLink p-3 hover:bg-emerald-800 text-white"
        >
            Admin_Menu
        </router-link>

    </div>

</template>

<script>
import api from "../api";
import router from "../router";

export default {
    name: "NavLinksOptions",
    props:[
        'shared_access_token',
        'users_role',
    ],

    methods: {
        // seeAccessToken(){
        //     console.log(this.$parent.$parent.access_token);
        // },

    },
    mounted() {

    },
    updated(){

    },


}
</script>

<style LANG="SCSS" scoped>

.links {
    display: none;
    overflow: hidden;

    a:hover {
        background-color: #354966;

    }
}
.dropDownMenu{
    z-index: 999;
}

.dropDownMenu:hover .links {
    display: block;
    position: absolute;
    color: white;
    background: #1A3051;
    min-width: 180px;
    max-width: 280px;
}

.dropDownMenu:hover .links a {
    display: block;
    padding: 6px 16px;
}



.btnLink:hover {
    background: linear-gradient(to bottom, #314663, rgb(26, 49, 80));
}


</style>
