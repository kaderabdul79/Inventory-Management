<template>
    <div id="login" class="h-100 bg-teal pa-3 rounded">
        <v-sheet width="500" class="mx-auto">
            <div class="text-h3 bg-teal-darken-1 text-center py-4">Login</div>
            <v-form class="pa-3" fast-fail @submit.prevent="handleLogin">
                <v-text-field
                    v-model="user.email"
                    label="email"
                ></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('email')" v-html="user.errors.get('email')" />

                <v-text-field
                    v-model="user.password"
                    label="password" type="password"
                ></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('password')" v-html="user.errors.get('password')" />

            <v-btn type="submit" block class="mt-2 bg-teal">Submit</v-btn>
            <span>Don't you have an account ? <router-link :to="{name: 'register'}">register here</router-link></span>
            </v-form>
        </v-sheet>
    </div>
</template>


<script setup>
import {ref,onMounted} from 'vue'
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
import {useRouter} from 'vue-router'
const router = useRouter()
import Form from 'vform'
const user = ref(new Form(
    {
        email: 'staff@gmail.com',
        password: '11111111',
    }
));

function handleLogin(){
    axios.get('sanctum/csrf-cookie').then(response => {
        // console.log(user.value.email);
    axios.post('login', {
      email: user.value.email,
      password: user.value.password,
    }).then(response => {
      console.log(response.data);
      localStorage.setItem('token', response.data.token); 
      router.push('/dashboard')
    }).catch(error => {
      console.error(error);
      user.value.errors.errors = error.response.data.errors;
    });
  });
}
onMounted(()=>{
    axios.get('sanctum/csrf-cookie').then(response => {
        console.log(response);
    });
})
</script>

<style scoped>
div#login {
    display: flex;
    align-items: center;
}
div.v-card-item{
    padding: 0px !important;
    background-color: red;
}
.social-login a .v-card-item{
    padding: 0px !important;
    background-color: red;
}
</style>