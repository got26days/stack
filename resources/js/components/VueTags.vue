<template>
    <div>
        <div
            class="d-flex w-100 justify-content-between align-items-center py-2"
        >
            <div></div>
            <div class="text-end">
                <div
                    class="btn-group"
                    role="group"
                    aria-label="Basic radio toggle button group"
                >
                    <a
                        href="/tags?tab=popular"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'popular' }"
                        >Popular</a
                    >
                    <a
                        href="/tags?tab=name"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'name' }"
                        >Name</a
                    >
                    <a
                        href="/tags?tab=new"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'new' }"
                        >New</a
                    >
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div
                    class="col-sm-12 col-md-6 col-lg-3"
                    v-for="tag in showTags"
                    :key="'tag' + tag.id"
                >
                    <div class="card text-center my-2">
                        <div class="card-body">
                            <a
                                :href="'/questions/tagged/' + tag.tag_name"
                                class="btn btn-primary"
                                >{{ tag.tag_name }}</a
                            >
                        </div>
                        <div class="card-footer text-muted">
                            created {{ tag.created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["tags", "tab"],
    data() {
        return {
            currentTab: "Popular",
            showTags: [],
        };
    },
    mounted() {
        this.showTags = this.tags.data;
        this.currentTab = this.tab;
        console.log("Component mounted.");
    },
};
</script>
