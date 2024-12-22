<template>
    <div class="mainDiv">

        <label for="email">Email:</label>
        <input v-model="email" id="email" type="text" placeholder="exemplu@exemplu.com">

        <label for="parola">Parola:</label>
        <div class="password-container">
            <input v-model="password" id="parola" :type="passwordVisible['password'] ? 'text':'password'"
                   placeholder="*******">
            <button class="toggle-visibility-btn"
                    @mousedown="togglePasswordVisible('password',true)"
                    @mouseup="togglePasswordVisible('password',false)"
                    @touchstart="togglePasswordVisible('password',true)"
                    @touchend="togglePasswordVisible('password',false)"
            >
                <i class="fa-solid fa-eye"></i>
            </button>
        </div>

        <button @click.prevent="login" class="regBtn">Loghează-te</button>
        <p v-if="error_message" class="text-center  text-red-500">{{error_message}}</p>
    </div>
</template>

<script>
import router from "../router";

export default {
    name: "RegisterComponent",
    data() {
        return {
            passwordVisible: {
                password: false,
                confirm_password: false,
            },
            email: null,
            password: null,
            access_token: null,
            error_message:null,
        }
    },
    methods: {
        togglePasswordVisible(field, value) {
            this.passwordVisible[field] = value;
        },
        async login() {
            try{
                const response = await axios.post('/api/auth/login', {'email': this.email, 'password': this.password});
                if (response.data.access_token) {
                    localStorage.setItem('access_token', response.data.access_token);
                    this.error_message=null;
                    await router.push({name: 'SearchIban'});
                }else {
                    console.log('Login or Password error!');
                }

            }catch(error){
                if (error.response && error.response.status === 401) {
                    this.error_message = "Email sau parola sunt incorecte. Încercați din nou.";
                } else {
                    this.error_message = "A apărut o eroare. Încercați mai târziu.";
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.mainDiv {
    display: flex;
    flex-direction: column;
    gap: 10px;
    box-shadow: 0 0 5px rgba(184, 184, 184, 0.5);
    width: 30%;
    min-width: 250px;
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    margin: auto;
    margin-top: 10px;

    input {
        background-color: transparent;
        outline: none;
        border-bottom: 1px solid grey;
        width: 70%;
        margin: auto;
        margin-top: 0;
        margin-bottom: 0;
    }

    label {
        margin-left: 15%;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 12px;
    }
}

.regBtn {
    width: 40%;
    min-width: 120px;
    border-radius: 5px;
    margin: auto;
    padding: 7px;
    border: 1px solid #2b548e;

    &:active {
        transform: translateY(2px);
    }

    &:hover {
        background-color: #2b548e;
        color: white;
    }
}

.password-container {
    display: flex;
    align-items: center;
    position: relative;

    input {
        width: 70%;
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
