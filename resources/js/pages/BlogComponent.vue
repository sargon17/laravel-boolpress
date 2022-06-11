<template>
    <div class="container">
        <div class="row">
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <nav aria-label="pagination">
                    <ul class="pagination">
                        <li class="page-item">
                            <a
                                class="page-link"
                                @click="() => previousPage()"
                                href="#"
                                aria-label="Previous"
                            >
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li
                            v-for="page in last_page"
                            :key="page"
                            :class="
                                'page-item' +
                                (page === current_page ? ' active' : '')
                            "
                        >
                            <a
                                class="page-link"
                                href="#"
                                @click="() => changePage(page)"
                                >{{ page }}</a
                            >
                        </li>
                        <li class="page-item">
                            <a
                                class="page-link"
                                @click="() => nextPage()"
                                href="#"
                                aria-label="Next"
                            >
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
            last_page: 0,
            current_page: 1,
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
                    this.posts = response.data.data;
                    this.last_page = response.data.last_page;
                    this.current_page = response.data.current_page;
                    console.log(this.posts);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        changePage(page) {
            window.axios
                .get("/api/posts?page=" + page)
                .then((response) => {
                    this.posts = response.data.data;
                    this.last_page = response.data.last_page;
                    this.current_page = response.data.current_page;
                    console.log(this.posts);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        previousPage() {
            if (this.current_page > 1) {
                this.changePage(this.current_page - 1);
            }
        },
        nextPage() {
            if (this.current_page < this.last_page) {
                this.changePage(this.current_page + 1);
            }
        },
    },
};
</script>

<style></style>
