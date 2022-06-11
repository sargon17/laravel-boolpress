<template>
    <div
        class="row border rounded overflow-hidden flex-md-row shadow-sm h-md-250 my-2 post-card position-relative"
    >
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">
                {{ post.category_name }}
            </strong>
            <h3 class="mb-0">{{ post.title }}</h3>
            <div class="mb-1 text-muted">{{ post.time_difference }}</div>
            <p class="card-text mb-auto">
                {{ textShorten(post.content, textLengthOnScreen()) }}
            </p>
            <!-- <a href="#" class="stretched-link">Continue reading</a> -->
            <!-- <div class="bottom-link"> -->
            <router-link
                class="stretched-link bottom-link"
                :to="{ name: 'blog-post', params: { slug: post.slug } }"
            >
                Continue reading
            </router-link>
            <!-- </div> -->
        </div>
        <div class="col-3 col-sm-3 col-md-6 m-0 p-0 img-wrapper">
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
    data() {
        return {
            windowWidth: document.documentElement.clientWidth,
        };
    },
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        window.addEventListener("resize", this.getWindowWidth);
    },
    unmounted() {
        window.removeEventListener("resize", this.getWindowWidth);
    },
    methods: {
        // window width is used to determine the length of the text on the screen
        getWindowWidth() {
            this.windowWidth = document.documentElement.clientWidth;
        },
        textLengthOnScreen() {
            let width = this.windowWidth;
            if (width < 200) return 30;
            if (width < 400) return 80;
            if (width < 600) return 120;
            if (width < 800) return 180;
            if (width < 1000) return 220;
            return 400;
        },
        textShorten(text, limit) {
            if (text.length < limit) return text;

            const shortText = text.substring(0, limit);
            return shortText + "...";
        },
    },
};
</script>

<style lang="scss" scoped>
h3 {
    font-size: 1.5rem;

    @media screen and (max-width: 600px) {
        font-size: 1.2rem;
    }
    @media screen and (max-width: 400px) {
        font-size: 1rem;
    }
}
p {
    // font-size: 0.8rem;

    @media screen and (max-width: 600px) {
        font-size: 0.9rem;
    }
    @media screen and (max-width: 400px) {
        font-size: 0.7rem;
    }
}

.post-card {
    width: 100%;
    // max-height: 300px;
    // min-height: 250px;

    // @media screen and (max-width: 600px) {
    //     min-height: 200px;
    // }
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
.bottom-link {
    // position: absolute;
    // bottom: 0;
    // left: 0;
    // height: 30px;
    // width: 100%;
    // background: linear-gradient(
    //     0deg,
    //     rgba(255, 255, 255, 1) 20%,
    //     rgba(255, 255, 255, 0.8) 70%,
    //     rgba(255, 255, 255, 0) 100%
    // );
    // padding: 5px 1.5rem;
}
</style>
