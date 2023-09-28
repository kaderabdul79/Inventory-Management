<template>
    <div id="dashboard">
        <!-- header -->
        <v-navigation-drawer
            v-model="drawer"
            :rail="rail"
            permanent
            @click="rail = false"
        >
        <v-list class="pa-0">
        </v-list>
            <v-list-item class="py-2" nav>
                <span class="text-h4 text-center pa-3">Inventory</span>
                <template v-slot:append>
                    <v-btn
                        variant="flat"
                        icon="mdi mdi-view-dashboard-outline"
                        @click.stop="rail = !rail"
                    ></v-btn>
                </template>
            </v-list-item>

            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item
                    prepend-icon="mdi-home-city"
                    title="Dashboard"
                    value="dashboard"
                    to="/dashboard"
                ></v-list-item>
                <v-list-item
                    prepend-icon="mdi-account"
                    title="My Account"
                    value="account"
                    to="/user/account"
                ></v-list-item>
                <!-- brands -->
                <v-list-group value="brands">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-watermark"
                            title="brands"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="brand in brands"
                        :key="brand.id"
                        :title="brand.title"
                        :prepend-icon="brand.icon"
                        :value="brand.title"
                        :to="{name: brand.name}"
                    ></v-list-item>
                </v-list-group>
                <!-- categories -->
                <v-list-group value="categories">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-shape"
                            title="categories"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="category in categories"
                        :key="category.id"
                        :title="category.title"
                        :prepend-icon="category.icon"
                        :value="category.title"
                        :to="{name: category.name}"
                    ></v-list-item>
                </v-list-group>
                <!-- sizes -->
                <v-list-group value="sizes">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-size-s"
                            title="sizes"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="size in sizes"
                        :key="size.id"
                        :title="size.title"
                        :prepend-icon="size.icon"
                        :value="size.title"
                        :to="{name: size.name}"
                    ></v-list-item>
                </v-list-group>
                <!-- products -->
                <v-list-group value="products">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-shopping"
                            title="products"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="product in products"
                        :key="product.id"
                        :title="product.title"
                        :prepend-icon="product.icon"
                        :value="product.title"
                        :to="{name: product.name}"
                    ></v-list-item>
                </v-list-group>
                <v-list-item
                    prepend-icon="mdi-account-group-outline"
                    title="Stocks"
                    value="stocks"
                    to="/dashboard/stocks"
                ></v-list-item>
            </v-list>
            <v-btn  @click="handleLogout" class="bg-primary ml-15 my-50">Logout<v-icon>mdi mdi-logout</v-icon></v-btn>
        </v-navigation-drawer>
        <!-- drawer -->
        <v-app-bar class="px-2" :elevation="2" background="#26A69A">
            <div class="my-header w-100" background="#26A69A">
            <div class="subtitle-2">Inventory Management</div>
            <div class="profile"> Hello,
                <span class="ml-2 subtitle-2">{{ user.name }}</span>
                <!--  -->
            </div></div>
        </v-app-bar>
        <!-- rendering all other dashboard pages/components from here -->
        <router-view />
        <!--  -->
    </div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import axios from 'axios'
axios.defaults.baseURL = "http://127.0.0.1:8000/api/"
import {useRouter} from 'vue-router'
const router = useRouter()
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

// Logout
const handleLogout = async () => {
    try {
        // remove token
        localStorage.removeItem('token');
        user.value = {};
        await router.push({ name: 'login' });
    } catch (error) {
        console.error('Error during logout:', error);
    }
};

// 
 onMounted(()=>{
    fetchUser()
})
// 
const profileDrawer = ref(false);
const drawer = ref(true);
const rail = ref(true);
function profileDrawerChange() {
    return (profileDrawer.value = !profileDrawer.value);
}

const brands = ref([
    { id: 1, title: "Manage", icon: "mdi mdi-controller-classic-outline", name: "brands"},
    { id: 2, title: "Create brands", icon: "mdi mdi-plus", name: "createBrand" },
]);
const categories = ref([
    { id: 1, title: "Manage", icon: "mdi mdi-controller-classic-outline", name: "categories"},
    { id: 2, title: "Create categories", icon: "mdi mdi-plus", name: "createCategory" },
]);
const sizes = ref([
    { id: 1, title: "Manage", icon: "mdi mdi-controller-classic-outline", name: "sizes"},
    { id: 2, title: "Create sizes", icon: "mdi mdi-plus", name: "createSize"},
]);
const products = ref([
    { id: 1, title: "Manage", icon: "mdi mdi-controller-classic-outline", name: "products"},
    { id: 2, title: "Create Product", icon: "mdi mdi-plus", name: "createProduct"},
]);
</script>

<style scoped>
.my-header{
    display: flex;
    justify-content: space-between;
}
.v-list-item.logout {
    position: absolute;
    bottom: 0;
}
</style>