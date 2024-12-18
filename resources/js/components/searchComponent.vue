<template>
    <div class="theParent">

        <div class="mainDiv">
            <div class="breadCrumb bg-[#FAFAFA] w-[80vw] m-auto pt-5 pl-[50px]">
                <div><a class="text-[#015BA8]" href="https://mf.gov.md/ro">Acasă</a> » Generarea codului IBAN pentru
                    încasări
                </div>
                <hr class="invisibleHrr">
            </div>

            <hr>
            <div class="childDiv">
                <span>Anul:</span>
                <select
                    class="w-[310px] h-[25px] selectul rounded-sm bg-gray-50 border border-sky-500 text-black text-sm focus:ring-2 focus:ring-blue-500 focus:ring-opacity-25 focus:outline-none block">
                    <option>2024</option>
                </select>
            </div>
            <hr class="invisibleHr">

            <div class="childDiv">
                <span>Codul Eco:</span>


                <select v-model="ecoDefaultCode"
                        class="w-[310px] h-[25px] selectul rounded-sm bg-gray-50 border border-sky-500 text-black text-sm focus:ring-2 focus:ring-blue-500 focus:ring-opacity-25 focus:outline-none block">

                    <option v-for="eco_code in eco_codes" :value="eco_code.codul">{{ eco_code.codul }}</option>
                </select>
            </div>
            <hr class="invisibleHr">

            <div class="childDiv">
                <span>Raionul:</span>
                <select @change="updateLocalities" v-model="raionDefaultCode"
                        class="w-[310px] h-[25px] selectul rounded-sm bg-gray-50 border border-sky-500 text-black text-sm focus:ring-2 focus:ring-blue-500 focus:ring-opacity-25 focus:outline-none block">
                    <option v-for="raion in raioane" :value="raion.code" :key="raion.code">{{ raion.code }} -
                        {{ raion.name }}
                    </option>
                </select>
            </div>
            <hr class="invisibleHr">

            <div class="childDiv">
                <span>Localitatea:</span>
                <select v-model="localitateDefaultCode"
                        class="w-[310px] h-[25px] selectul rounded-sm bg-gray-50 border border-sky-500 text-black text-sm focus:ring-2 focus:ring-blue-500 focus:ring-opacity-25 focus:outline-none block">

                    <option v-for="localitate in localitati" :value="localitate.code" :key="localitate.code">
                        {{ localitate.code }} - {{ localitate.name }}
                    </option>
                </select>
            </div>
            <hr class="invisibleHr">

            <button class="afiseazaCodulIban" @click.prevent="afiseazaIban">Afișează codul iban</button>
            <p v-if="theIbanCode">{{theIbanCode}}</p>
            <hr>
        </div>
    </div>


</template>

<script>
export default {
    name: "searchComponent",
    data() {
        return {
            raioane: [],
            localitati: [],
            eco_codes: null,

            ecoDefaultCode: "",
            raionDefaultCode: "",
            localitateDefaultCode: "",

            theIbanCode:null,
        }
    },
    methods: {
        selectInformation() {
            axios.get('/api/selectInfo').then(res => {

                this.eco_codes = res.data.eco_codes;
                if (this.eco_codes.length > 0) {
                    this.ecoDefaultCode = this.eco_codes[0].codul;
                }


                this.raioane = res.data.cities.map(city => ({
                    name: city.name,
                    code: city.code,

                }));
                this.localitati = res.data.localities.map(localitate => ({
                    name: localitate.name,
                    code: localitate.codul,
                }))


                if (this.raioane.length > 0) {
                    this.raionDefaultCode = this.raioane[0].code;
                }

                if (this.localitati.length > 0) {
                    this.localitateDefaultCode = this.localitati[0].code;
                }
            }).catch(error => {
                console.error("Error fetching data:", error);

            });
        },
        updateLocalities(event) {
            axios.get(`/api/updateLocalities/${event.target.value}`).then(res => {
                this.localitati = res.data.localities.map(localitate => ({
                    name: localitate.name,
                    code: localitate.codul,
                }))

                if (this.localitati.length > 0) {
                    this.localitateDefaultCode = this.localitati[0].code;
                }
            });
        },

        afiseazaIban() {
            // console.log("Codul eco selectat: "+this.ecoDefaultCode);
            // console.log("Raionul selectat: " + this.raionDefaultCode);
            // console.log("Localitatea selectata: " + this.localitateDefaultCode);

            axios.post('/api/extractIban', {'eco':this.ecoDefaultCode, 'raion':this.raionDefaultCode, 'localitate':this.localitateDefaultCode}).then(res =>{
                this.theIbanCode = res.data.iban_code;
            })
        }
    },
    mounted() {
        this.selectInformation();
    }
}
</script>

<style lang="scss" scoped>
.mainDiv {
    display: flex;
    flex-direction: column;
    width: 80vw;
    margin: 0 auto;
    align-items: center;
    background-image: linear-gradient(to bottom, white, transparent);
}

hr {
    border: 0;
    height: 1px;
    background-color: #ACACAC;
    width: 50%;
    margin: 10px 0;
}

.invisibleHr {
    border: 0;
    height: 0.5px;
    background-color: #EEEEEE;
    width: 50%;
    margin: 10px 0;
}

.invisibleHrr {
    border: 0;
    height: 1px;
    background-color: #EEEEEE;
    width: 335px;
}

.theParent {
    background-color: #fff;
    background-image: url('main-gradient.png');
    background-repeat: repeat-x;
    background-position: top;
}

.childDiv {
    display: flex;
    width: 50%;
    margin: 0 auto;

    span {
        width: 200px;
        margin-left: 20px;
    }
}

.afiseazaCodulIban {
    color: white;
    background-color: #1B4C9A;
    border-radius: 3px;
    width: 310px;
    height: 40px;
    font-weight: bold;

    &:hover {
        background-color: #003580;
    }
}


@media (max-width: 756px) {
    .invisibleHrr {
        width: 285px;
    }
}
</style>
