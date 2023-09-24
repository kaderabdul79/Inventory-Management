<template>
    <div id="createproduct">
        <v-container fluid>
            <!-- {{ product }} -->
            <v-row>
                <v-col cols="6" xs="12" offset="3">
                    <v-card class="mx-auto bg-teal" max-width="344" v-if="user">
                            <v-card-item>
                                <div>
                                <div class="text-h6 mb-1">
                                   {{ user.name }}
                                </div>
                                <div class="text-h6 mb-1">
                                    {{ user.email }}
                                </div>
                                <div class="text-caption">logout</div>
                                </div>
                            </v-card-item>
                        </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
const user = ref({})

const fetchUser = async () => {
    try {
        const storedToken = localStorage.getItem('token');

        if (storedToken) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${storedToken}`;
            
            const response = await axios.get('/user');
            user.value = response.data.data;
            // console.log("from fetchuser",user.value);
        }
    } catch (error) {
        console.error('Error fetching user:', error);
        if (error.response && error.response.status === 401) {
            handleLogout();
        }
    }
};
// 
 onMounted(()=>{
    fetchUser()
})

// Logout
const handleLogout = () => {
    user.value = null;
    
    // Remove token from local storage
    localStorage.removeItem('token');
    
    // Redirect to the login page
    router.push({ name: 'login' });
};
</script>

<style scoped>

</style>