<template>
    <div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">
                                {{ post.title }}
                            </h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">
                                Posted on {{ post.updated_at }} by Loqiemean
                            </div>
                            <!-- Post categories-->
                            <a
                                class="badge bg-secondary text-decoration-none link-light"
                                href="#!"
                                >{{ post.category }}</a
                            >
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4">
                            <img
                                class="img-fluid rounded"
                                :src="'/storage/' + post.image"
                                alt="..."
                            />
                        </figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4">
                                {{ post.content }}
                            </p>
                        </section>
                    </article>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Tags widget-->
                    <div class="card mb-4">
                        <div class="card-header">Tags</div>
                        <div class="card-body">
                            <ul class="row list-unstyled mb-0">
                                <li
                                    class="col-sm-6"
                                    v-for="tag in post.tags"
                                    :key="tag"
                                >
                                    <a href="#!">{{ tag }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">
                            You can put anything you want inside of these side
                            widgets. They are easy to use, and feature the
                            Bootstrap 5 card component!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogPostComponent",
    data() {
        return {
            post: {},
        };
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            window.axios
                .get("/api/posts/" + this.$route.params.slug)
                .then((response) => {
                    // console.log(response);
                    this.post = response.data.result;
                    // console.log(this.post);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
