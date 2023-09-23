<template>
    <div id="register" class="h-100 bg-teal pa-3 rounded">
        <v-sheet width="500" class="mx-auto">
            <div class="text-h3 bg-teal-darken-2 text-center py-4">Registration</div>
            <v-form class="pa-3" fast-fail @submit.prevent="handleRegistration">

                <v-text-field v-model="user.name" label="Name"></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('name')" v-html="user.errors.get('name')" />

                <v-text-field v-model="user.email"  label="email"></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('email')" v-html="user.errors.get('email')" />

                <v-text-field v-model="user.password" type="password" label="password"></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('password')" v-html="user.errors.get('password')" />

                <v-text-field v-model="user.password_confirmation" type="password" label="Confirm Password"></v-text-field>
                <div class="text-subtitle-2 text-red" v-if="user.errors.has('password_confirmation')" v-html="user.errors.get('password_confirmation')" />

            <v-btn type="submit" block class="my-2 bg-teal">Submit</v-btn>
            <span>Do you have an account ? <router-link :to="{name: 'login'}">login</router-link></span>
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
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    }
));

function handleRegistration(){
    axios.get('sanctum/csrf-cookie').then(response => {
        // console.log(user.value.email);
    axios.post('register', {
      name: user.value.name,
      email: user.value.email,
      password: user.value.password,
      password_confirmation: user.value.password_confirmation,
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
div#register {
    display: flex;
    align-items: center;
}
div.v-card-item{
    padding: 0px !important;
    background-color: red;
}
.social-register a .v-card-item{
    padding: 0px !important;
    background-color: red;
}
</style>