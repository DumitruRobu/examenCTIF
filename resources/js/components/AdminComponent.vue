<template>

    <div v-if="users" class="mt-[50px]">
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
                <td>{{user.id}}</td>
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
</template>

<script>
import api from '../api.js';

export default {
    name: "AdminComponent",
    data(){
        return{
            users:[],
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
                console.log(res.data);
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
</style>
