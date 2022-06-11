<template>
    <div
        class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250 my-2 position-relative post-card"
    >
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">
                {{ post.category }}
            </strong>
            <h3 class="mb-0">{{ post.title }}</h3>
            <div class="mb-1 text-muted">{{ post.created_at }}</div>
            <p class="card-text mb-auto">
                {{ textShorten(post.content, 250) }}
            </p>
            <!-- <a href="#" class="stretched-link">Continue reading</a> -->
            <router-link
                class="stretched-link"
                :to="{ name: 'blog-post', params: { slug: post.slug } }"
            >
                Continue reading
            </router-link>
        </div>
        <div class="col m-0 p-0 img-wrapper">
            <img
                v-if="post.image"
                class="img-fluid"
                :src="'/storage/' + post.image"
                :alt="post.title"
            />
            <img
                v-else
                class="img-fluid"
                src="https://images.unsplash.com/photo-1552308995-2baac1ad5490?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                :alt="post.title"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCard",
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
    methods: {
        textShorten(text, limit) {
            if (text.length < limit) return text;
            const shortText = text.substring(0, limit);
            return shortText + "...";
        },
    },
};
</script>

<style lang="scss" scoped>
.post-card {
    width: 100%;
    max-height: 300px;
}

.img-wrapper {
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.img-fluid {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
