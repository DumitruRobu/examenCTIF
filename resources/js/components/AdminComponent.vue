<template>

    <div class="text-white flex gap-4 text-center align-start justify-center linksDiv">
        <router-link :to="{name:'AdaugaUtilizator'}"><i class="fa-solid fa-plus"></i> Adauga Utilizator</router-link>
        <router-link :to="{name:'GenereazaIban'}"><i class="fa-solid fa-check"></i> Validare cod Iban</router-link>
        <router-link :to="{name:'VizualizeazaCoduriIban'}"><i class="fa-solid fa-code"></i> Vezi codurile iban</router-link>
        <router-link :to="{name:'creazaCodIban'}"><i class="fa-solid fa-plus"></i> Creaza Cod Iban</router-link>
    </div>


    <div v-if="users" class="">
        <table class="text-white">
            <tr>
                <th>#</th>
                <th>Nume</th>
                <th>Email</th>
                <th>Raion operare</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr v-for="user in users">
                <td>{{user.id}}.</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.raion_id ? user.raion_id.name : 'Global view'}}</td>
                <td>
                    <router-link :to="{name:'EditUser', params:{'id':user.id}}"> Edit user </router-link>
                </td>

                <td>
                    <button @click.prevent="deleteUser(user.id)">Delete User</button>
                </td>
            </tr>
        </table>
    </div>

    <div class="theMessage" v-if="theMessage">
        {{theMessage}}
    </div>
</template>

<script>
import api from '../api.js';

export default {
    name: "AdminComponent",
    data(){
        return{
            users:[],
            theMessage:null,
        }
    },
    mounted() {
        this.getAllUsers()
    },
    methods:{
        getAllUsers(){
            api.get('/api/auth/getAllUsers').then(res =>{
                this.users = res.data.data;
                console.log(res.data.data);
            });
        },
        deleteUser(id){
            api.delete(`/api/auth/deleteUser/${id}`).then(res =>{
                this.getAllUsers();
                if(res.data.message === 'User has been deleted successfully!'){
                    alert(res.data.message);
                }else{
                    alert("Smth went wrong, pls contact the developer!");
                }
            })
        }
    }
}
</script>

<style lang="scss" scoped>
table{
    border:1px solid white;
    margin:10px auto;
    width:60%;
    td,th{
        border:1px solid white;
        padding:10px;
    }
}
a:hover{
    text-decoration: underline;
}
button{
    padding:5px;
}
button:hover{
    background-color: #ee728d;

    border-radius:10px;
}
.theMessage{
    border:3px solid #ff17e8;
    background-color: rgba(164, 177, 215, 0.8);
    width:40%;
    height:20%;
    position:absolute;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%);
    color: #a02323;
    font-size:40px;
    text-align: center;
    animation: disappearingEffect 3s ease-in-out;
}
@keyframes disappearingEffect {
    from{
        opacity:1;
    }
    to{
        opacity:0;
    }
}
.linksDiv{
    margin-top:40px;
}
</style>
