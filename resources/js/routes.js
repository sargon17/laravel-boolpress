import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomeComponent from "./pages/HomeComponent.vue";
import BlogComponent from "./pages/BlogComponent.vue";
import BlogPostComponent from "./pages/BlogPostComponent.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeComponent,
        },
        {
            path: "/blog",
            name: "blog",
            component: BlogComponent,
        },
        {
            path: "/blog/:slug",
            name: "blog-post",
            component: BlogPostComponent,
        },
    ],
});

export default router;
