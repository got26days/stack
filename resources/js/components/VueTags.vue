<template>
    <div>
        <div
            class="d-flex w-100 justify-content-between align-items-center py-2"
        >
            <div>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search..."
                    v-model="search"
                />
            </div>
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
            <div class="row" v-if="search == ''">
                <div
                    class="col-sm-12 col-md-6 col-lg-3"
                    v-for="tag in showTags"
                    :key="'tag' + tag.id"
                >
                    <div class="card text-center my-2">
                        <div class="card-body">
                            <p>{{ tag.count }} questions</p>
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

            <div class="row" v-if="search != ''">
                <div
                    class="col-sm-12 col-md-6 col-lg-3"
                    v-for="tag in searchTags"
                    :key="'searchtag' + tag.id"
                >
                    <div class="card text-center my-2">
                        <div class="card-body">
                            <p>{{ tag.count }} questions</p>
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
            search: "",
            searchTags: [],
        };
    },
    watch: {
        search: function (newVal) {
            this.searchTags = [];

            if (newVal == "" || newVal == null) {
                document.getElementById("tags-pagination").style.display =
                    "block";
                return;
            }

            document.getElementById("tags-pagination").style.display = "none";

            this.debounceTags();
        },
    },
    mounted() {
        this.showTags = this.tags.data;
        this.currentTab = this.tab;
        console.log("Component mounted.");
    },
    methods: {
        debounceTags: _.debounce(function () {
            axios
                .get("/tags/search", {
                    params: {
                        tag: this.search,
                    },
                })
                .then((res) => {
                    console.log(res.data);
                    this.searchTags = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        }, 500),
    },
};
</script>
