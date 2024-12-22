<template>
    <div class="mainDiv">
        <label for="nume">Nume de utilizator:</label>
        <input id="nume" v-model="name" type="text" placeholder="Ion Ionescu">

        <label for="email">Email:</label>
        <input id="email" v-model="email" type="text" placeholder="exemplu@exemplu.com">

        <label for="parola">Parola:</label>
        <div class="password-container">
            <input id="parola" v-model="password" :type="passwordVisible['password'] ? 'text':'password'" placeholder="*******" >
            <button class="toggle-visibility-btn"
                @mousedown="togglePasswordVisible('password',true)"
                @mouseup="togglePasswordVisible('password',false)"
                @mouseleave="togglePasswordVisible('password',false)"
                @touchstart="togglePasswordVisible('password',true)"
                @touchend="togglePasswordVisible('password',false)"
            >
                <i class="fa-solid fa-eye"></i>

            </button>
        </div>

        <label for="password_confirm">Confirma Parola:</label>
        <div class="password-container">
            <input v-model="password_confirmation" id="password_confirm" :type="passwordVisible['confirm_password'] ? 'text':'password'" placeholder="*******">
            <button class="toggle-visibility-btn"
                @mousedown="togglePasswordVisible('confirm_password',true)"
                @mouseup="togglePasswordVisible('confirm_password',false)"
                @mouseleave="togglePasswordVisible('confirm_password',false)"
                @touchstart="togglePasswordVisible('confirm_password',true)"
                @touchend="togglePasswordVisible('confirm_password',false)"
            >
                <i class="fa-solid fa-eye"></i>
            </button>
        </div>

        <button @click.prevent="register" class="regBtn">Înregistrează-te</button>
        <p v-if="error" class="text-center text-red-500">{{error}}</p>
    </div>

</template>

<script>
import router from "../router";

export default {
    name: "RegisterComponent",
    data(){
        return{
            passwordVisible:{
                password:false,
                confirm_password:false,
            },
            name:null,
            email:null,
            password:null,
            password_confirmation:null,
            access_token:null,
            error:null,
        }
    },
    methods:{
        togglePasswordVisible(field, value){
            this.passwordVisible[field]= value;
        },
        async register(){
            try{
                if (!this.name || !this.email || !this.password || !this.password_confirmation) {
                    alert('All fields are required!');
                    return;
                }

                const response = await axios.post('/api/register', {
                    'name': this.name,
                    'email': this.email,
                    'password': this.password,
                    'password_confirmation': this.password_confirmation
                });

                if(response.data.access_token){
                    console.log("Registered successfully!");
                    this.access_token = response.data.access_token;
                    this.error=null;
                    localStorage.setItem('access_token', this.access_token);
                    await router.push({name: 'SearchIban'})
                    // alert('Registered successfully!');
                } else {
                    console.log('Failed to receive token');
                }

            }catch(error){
                console.log('Error:', error.response?.data?.message || error.message);
                this.error = error.response?.data?.message || 'An unknown error occurred!';
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.mainDiv{
    display:flex;
    min-width:250px;
    flex-direction: column;
    gap:10px;
    box-shadow: 0 0 5px rgba(184, 184, 184, 0.5);
    width:30%;
    background-color: white;
    padding:20px;
    border-radius: 5px;
    margin:auto;
    margin-top:10px;

    input{
        background-color: transparent;
        outline:none;
        border-bottom:1px solid grey;
        width:70%;
        margin:auto;
        margin-top:0;
        margin-bottom: 0;
    }
    label{
        margin-left:15%;
        margin-top:0;
        margin-bottom: 0;
        font-size: 12px;
    }
}

.regBtn{
    width:40%;
    min-width:150px;
    border-radius: 5px;
    margin:auto;
    padding:7px;
    border:1px solid #2b548e;
    &:active{
        transform:translateY(2px);
    }
    &:hover{
        background-color: #2b548e;
        color:white;
    }
}
.password-container{
    display:flex;
    align-items:center;
    position:relative;
    input{
        width:70%;
    }
    .toggle-visibility-btn {
        position: absolute;
        right: calc(15% + 5px);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }
}

</style>
