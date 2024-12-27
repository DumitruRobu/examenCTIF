<template>
    <div class="flex flex-col gap-2 items-center align-center">
        <p>Codurile iban:</p>

        <div id="searchUl">
            <input id="searchBox" type="text" v-model="searchQuery" @input="searchCodes"  placeholder="Seach by code...">
        </div>

        <div v-if="!allIbans" class="mt-4 mx-auto text-white flex">
            <img  class="w-5 mr-2" src="../../../public/loading.gif" alt="loadingIcon"> Loading...
        </div>

        <table v-if="allIbans">
            <tr>
                <th>#</th>
                <th>codul eco</th>
                <th>raion cod</th>
                <th>cod localitate</th>
                <th>iban cod</th>

                <th>delete</th>
            </tr>
            <tr v-for="iban in allIbans">
                <td>{{iban.id}}</td>
                <td>{{iban.codul_eco}}</td>
                <td>{{iban.raion}}</td>
                <td>{{iban.localitatea}}</td>
                <td>{{iban.codul_iban}}</td>

                <td><button @click.prevent="deleteCodEco(iban.id)">delete</button></td>
            </tr>
        </table>


        <div v-if="pagination" class="flex gap-2 items-center align-center">
            <button v-if="pagination.prev_page_url" @click.prevent="getAllIbans(pagination.prev_page_url)">Previous
            </button>
            <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
            <button v-if="pagination.next_page_url" @click.prevent="getAllIbans(pagination.next_page_url)">Next</button>
            <button v-if="pagination.last" @click.prevent="getAllIbans(pagination.last)">Last</button>
        </div>

    </div>
</template>

<script>
import api from '../api';

export default {
    name: "VizualizeazaCoduriIban",
    data() {
        return {
            allIbans: null,
            pagination: null,
            functionTriggered:false,
            searchQuery:null,
        }
    },
    methods: {

        deleteCodEco(id){
            api.delete(`/api/auth/deleteIban/${id}`).then(res =>{
                alert(res.data.message);
                this.getAllIbans();
            })
        },
        getAllIbans(url = '/api/auth/getAllIbans') {
            this.functionTriggered = true;
            api.get(url, {
                params:{ search: this.searchQuery }
            }).then(res => {
                console.log(res.data.ibans);
                this.allIbans = res.data.ibans.data;

                this.pagination = {
                    current_page: res.data.ibans.meta.current_page,
                    last_page: res.data.ibans.meta.last_page,
                    prev_page_url: res.data.ibans.links.prev,
                    next_page_url: res.data.ibans.links.next,
                    last: res.data.ibans.links.last,
                };
            }).catch(error => {
                console.log('Error fetching ibans: ', error);
            });
            this.functionTriggered = false;
        },
        searchCodes(){
            this.getAllIbans();
        }
    },
    mounted() {
        this.getAllIbans();
    },
}
</script>

<style scoped>
* {
    color: white;
    font-size: 12px;
}
table, td,th, tr{
    padding:10px;
    border:1px solid white;
}

table{
    width:50%;
}
button:hover{
    text-decoration: underline;
}
.thePagination{
    font-size: 25px;
}
#searchBox{
    color:black;
    border-radius:5px;
    padding:5px;

}
</style>
