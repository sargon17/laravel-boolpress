<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="sidebar">
                    <div class="sidebar-header">
                        <h3>Categories</h3>
                    </div>
                    <div class="sidebar-content">
                        <ul class="list-group">
                            <li
                                :class="
                                    'list-group-item list-group-item-action' +
                                    (selected_category == 'all'
                                        ? ' active'
                                        : '')
                                "
                            >
                                All
                            </li>
                            <li
                                class="list-group-item list-group-item-action"
                                v-for="category in categories"
                                :key="category.id"
                            >
                                {{ category.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="container">
                    <div class="row">
                        <PostCard
                            v-for="post in posts"
                            :key="post.id"
                            :post="post"
                        />
                    </div>
                    <div class="row">
                        <div
                            class="col-12 d-flex justify-content-center align-items-center"
                        >
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    <li
                                        :class="
                                            'page-item' +
                                            // (current_page === 1 ? 'disabled' : '')
                                            ' disabled'
                                        "
                                    >
                                        <a
                                            v-if="current_page !== 1"
                                            class="page-link"
                                            @click.prevent="
                                                () => previousPage()
                                            "
                                            href="#"
                                            aria-label="Previous"
                                        >
                                            <span aria-hidden="true"
                                                >&laquo;</span
                                            >
                                        </a>
                                        <span
                                            v-else
                                            class="page-link"
                                            aria-hidden="true"
                                            >&laquo;</span
                                        >
                                    </li>
                                    <li
                                        v-for="page in last_page"
                                        :key="page"
                                        :class="
                                            'page-item' +
                                            (page === current_page
                                                ? ' active'
                                                : '')
                                        "
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click.prevent="
                                                () => {
                                                    if (page === current_page)
                                                        return;
                                                    getPosts(page);
                                                    scrollTop();
                                                }
                                            "
                                            >{{ page }}</a
                                        >
                                    </li>
                                    <li
                                        :class="
                                            'page-item' +
                                            (current_page == last_page
                                                ? ' disabled'
                                                : '')
                                        "
                                    >
                                        <a
                                            v-if="current_page !== last_page"
                                            class="page-link"
                                            @click.prevent="() => nextPage()"
                                            href=""
                                            aria-label="Next"
                                        >
                                            <span aria-hidden="true"
                                                >&raquo;</span
                                            >
                                        </a>
                                        <span
                                            v-else
                                            class="page-link"
                                            aria-hidden="true"
                                            >&raquo;</span
                                        >
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
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
            categories: [],
            selected_category: "all",
        };
    },
    components: {
        PostCard,
    },
    mounted() {
        this.getPosts(this.current_page, 1);
        this.getCategories();
    },
    methods: {
        getPosts(page, category) {
            let params = {
                // category_id: category,
                page: page,
            };
            window.axios
                .get(`/api/posts`, {
                    params: params,
                })
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
                this.getPosts(this.current_page - 1);
                this.scrollTop();
            }
        },
        nextPage() {
            if (this.current_page < this.last_page) {
                this.getPosts(this.current_page + 1);
                this.scrollTop();
            }
        },
        scrollTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        },
        getCategories() {
            window.axios
                .get("/api/categories")
                .then((response) => {
                    this.categories = response.data;
                    console.log(this.categories);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style></style>
