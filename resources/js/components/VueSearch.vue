<template>
    <div>
        <div
            class="d-flex w-100 justify-content-between align-items-center py-2"
        >
            <div class="text-end">
                <div
                    class="btn-group"
                    role="group"
                    aria-label="Basic radio toggle button group"
                >
                    <a
                        :href="'/search?search=' + req + '&tab=relevance'"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'relevance' }"
                        >Relevance</a
                    >
                    <a
                        :href="'/search?search=' + req + '&tab=newest'"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'newest' }"
                        >Newest</a
                    >
                    <a
                        :href="'/search?search=' + req + '&tab=voters'"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'voters' }"
                        >Voters</a
                    >
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="list-group">
                    <div
                        class="list-group-item list-group-item-action"
                        v-for="post in showresults"
                        :key="'res' + post.id"
                    >
                        <div class="d-flex w-100 justify-content-start">
                            <div class="px-2">
                                <span class="badge bg-success">{{
                                    post.score
                                }}</span>
                            </div>
                            <div>
                                <a
                                    class="mb-1"
                                    :href="
                                        '/questions/' +
                                        post.id +
                                        '/' +
                                        post.slug
                                    "
                                    >{{ post.title }}</a
                                >
                                <div v-if="post.tagsArray.length > 0">
                                    <h6>
                                        Tags:
                                        <span
                                            class="badge bg-secondary"
                                            style="margin-right: 3px"
                                            v-for="tag in post.tagsArray"
                                            :key="'tag' + tag"
                                            >{{ tag }}</span
                                        >
                                    </h6>
                                </div>

                                <small>{{ post.created_at }}</small>
                                <div v-if="post.user">
                                    <small>Asked:</small>
                                    <a
                                        :href="
                                            '/users/' +
                                            post.user.id +
                                            '/' +
                                            post.user.display_name
                                        "
                                        >{{ post.user.display_name }}</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["results", "tab", "req"],
    data() {
        return {
            currentTab: "Relevance",
            showresults: [],
        };
    },
    mounted() {
        this.showresults = this.results;
        this.currentTab = this.tab;
    },
};
</script>
