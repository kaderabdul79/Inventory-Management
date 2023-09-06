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
                    title="Home"
                    value="home"
                ></v-list-item>
                <v-list-item
                    prepend-icon="mdi-account"
                    title="My Account"
                    value="account"
                ></v-list-item>
                <v-list-group value="Users">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi-account-group-outline"
                            title="Users"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="user in users"
                        :key="user.id"
                        :title="user.title"
                        :prepend-icon="user.icon"
                        :value="user.title"
                        :to="{name: user.name}"
                    ></v-list-item>
                </v-list-group>
                <!-- users end -->
                <v-list-item
                    prepend-icon="mdi-account-group-outline"
                    title="Users"
                    value="users"
                ></v-list-item>
            </v-list>

            <v-list-item
                class="logout"
                prepend-icon="mdi mdi-logout"
                title="Logout"
                value="logout"
            ></v-list-item>
        </v-navigation-drawer>
        <!-- drawer -->
        <v-app-bar class="px-2" :elevation="2" background="#26A69A">
            <div class="my-header w-100" background="#26A69A">
            <div class="pt-2">Inventory Management</div>
            <div class="profile">
                <v-avatar size="36px">
                    <v-img
                        alt="Avatar"
                        src="https://avatars0.githubusercontent.com/u/9064066?v=4&s=460"
                    ></v-img>
                </v-avatar>
                <span class="ml-2 subtitle-2">Abdul Kader</span>
                <!--  -->
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn
                            size="small"
                            variant="text"
                            icon="mdi-menu-down"
                            :ripple="false"
                            v-bind="props"
                        ></v-btn>
                    </template>
                    <v-list>
                        <v-list-item
                            prepend-icon="mdi-account"
                            title="Users Profile"
                            value="users"
                        ></v-list-item>
                        <v-list-item
                            prepend-icon="mdi mdi-logout"
                            title="Logout"
                            value="Logout"
                        ></v-list-item>
                    </v-list>
                </v-menu>
            </div></div>
        </v-app-bar>
        <!-- rendering all other dashboard pages/components from here -->
        <router-view />
        <!--  -->
    </div>
</template>

<script setup>
import { ref } from "vue";
const profileDrawer = ref(false);
const drawer = ref(true);
const rail = ref(true);
function profileDrawerChange() {
    return (profileDrawer.value = !profileDrawer.value);
}
const items = ref([
    { title: "Click Me" },
    { title: "Click Me" },
    { title: "Click Me" },
    { title: "Click Me 2" },
]);
const users = ref([
    { id: 1, title: "Manage", icon: "mdi mdi-controller-classic-outline"},
    { id: 2, title: "Create User", icon: "mdi mdi-plus" },
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