<template>
    <div>
        <HeaderComponent />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderComponent from "../components/HeaderComponent.vue";
export default {
    name: "AppComponent",
    components: {
        HeaderComponent,
    },
};
</script>

<style></style>
