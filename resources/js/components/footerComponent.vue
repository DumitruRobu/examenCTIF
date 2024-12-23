<template>
    <div class="flex flex-col justify-center m-auto">
        <div class="flex p-5 justify-center">

            <div class="p-5">
                <p class="mb-1 text-white font-serif text-base">Contacte</p>
                <p class="text-white font-serif text-xs tracking-wide">
                    str. Constantin Tănase 7, mun. Chişinău <br>
                    MD-2005, Republica Moldova <br>
                    Tel.: +(373) 22 26 25 23 <br>
                    Email: cancelaria@mf.gov.md <br>
                </p>
            </div>

            <div class="mt-5 mr-2">
                <img class="h-[55px]" src="logo.png">
            </div>

            <div class="mt-5">
                <p class="text-white font-serif text-base mb-1">Ministerul Finanțelor</p>
                <p class="text-white font-serif text-xs">
                    Drepturi de autor © 2024. <br>
                    Toate drepturile sunt rezervate. <br>
                </p>
            </div>

            <div class="p-5">
                <p class="text-white font-serif text-base mb-1">Parteneri de dezvoltare</p>
                <p class="text-white font-serif text-xs">
                    Uniunea Europeană <br>
                    Fondul Monetar Internațional <br>
                    Banca Mondială <br>
                    Banca Europeană pentru Reconstrucție și <br> Dezvoltare <br>
                </p>
            </div>

            <div class="p-5">
                <p class="text-white font-serif text-base mb-1">Portaluri guvernamentale</p>
                <p class="text-white font-serif text-xs">
                    Portalul serviciilor publice<br>
                    Portalul de participare<br>
                    Portalul datelor deschise<br>
                    Registrul actelor juridice<br>
                    Servicii fiscale electronice<br>
                </p>
            </div>

            <div class="flex justify-center items-center mb-[60px]">
                <img class="h-[55px] p-2" src="eu_flag.jpg">
                <p class="text-white font-serif text-xs">Acest site a fost reînnoit cu <br>asistența Uniunii Europene</p>
            </div>
        </div>

        <div class="lastLink">
            <a href="https://old.mf.gov.md/" class="text-white underline ">
                Versiunea precedentă a paginii web a Ministerului Finanțelor!
            </a>
        </div>
    </div>


</template>

<script>
export default {
    name: "footerComponent"
}
</script>

<style scoped>
*{
    font-family: arial,serif;
}
.lastLink{
    display:flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding:0;
    margin-bottom:10px;
    animation: appear 3s ease-in-out infinite;
}
@keyframes appear {
    0%{
        opacity:0;
    }
    50%{
        opacity:0.5;
    }
    100%{
        opacity:1;
    }
}
</style>
