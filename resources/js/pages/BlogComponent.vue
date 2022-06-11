<template>
    <div class="container">
        <div class="row">
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
    </div>
</template>

<script>
import PostCard from "../components/PostCardComponent.vue";
export default {
    name: "BlogComponent",
    data() {
        return {
            posts: [],
        };
    },
    components: {
        PostCard,
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            window.axios
                .get("/api/posts")
                .then((response) => {
                    console.log(response);
                    this.posts = response.data.results;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
