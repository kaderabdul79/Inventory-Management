<template>
    <div id="overview">
        <v-container fluid>
            <v-row>
                <v-col>
                <v-sheet class="bg-grey-lighten-3 py-5 pl-2 text-blue-lighten-1 rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Sales</div>
                    <span class="text-h4">54</span>
                </v-sheet>
                </v-col>
                <v-col>
                <v-sheet class="bg-grey-lighten-3 py-5 pl-2 bl-2-red text-deep-purple-accent-1 rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Growth</div>
                    <span class="text-h4">23</span><span class="text-red">%</span>
                </v-sheet>
                </v-col>
                <v-col>
                <v-sheet class="bg-grey-lighten-3 py-5 pl-2 bl-2-red text-blue-lighten-1 rounded border-left-5 text--primary" :elevation="3">
                    <div class="text-h6 text-uppercase">Profit</div>
                    <span class="text-h4">61</span><span class="text-red">%</span>
                </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script setup>

</script>

<style scoped>

</style>