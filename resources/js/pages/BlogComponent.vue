<template>
    <div class="container">
        <div class="row mb-2">
            <div v-for="post in posts" :key="post.id" class="col-md-6">
                <div
                    class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
                >
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary"
                            >World</strong
                        >
                        <h3 class="mb-0">{{ post.title }}</h3>
                        <div class="mb-1 text-muted">{{ post.created_at }}</div>
                        <p class="card-text mb-auto">
                            {{ post.component }}
                        </p>
                        <a href="#" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img
                            class="bd-placeholder-img"
                            width="200"
                            height="250"
                            :src="'storage/' + post.image"
                            :alt="post.title"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogComponent",
    data() {
        return {
            posts: [],
        };
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
                    this.posts = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
