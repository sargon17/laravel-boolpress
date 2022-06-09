<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hello</h1>
                <p>This is the Vue.js app.</p>
                <p>
                    <router-link to="/">Home</router-link>
                    <router-link to="/about">About</router-link>
                </p>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppComponent",
    data() {
        return {
            message: "Hello Vue!",
        };
    },
};
</script>

<style></style>
