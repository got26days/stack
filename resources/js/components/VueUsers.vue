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
                        href="/users?tab=reputation"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'reputation' }"
                        >Reputation</a
                    >
                    <a
                        href="/users?tab=new users"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'new users' }"
                        >New users</a
                    >
                    <a
                        href="/users?tab=voters"
                        class="btn btn-outline-primary"
                        :class="{ active: currentTab == 'voters' }"
                        >Voters</a
                    >
                </div>
            </div>
        </div>
        <div>
            <div class="row" v-if="search == ''">
                <div
                    class="col-sm-12 col-md-6 col-lg-3"
                    v-for="user in showUsers"
                    :key="'user' + user.id"
                >
                    <div class="card text-center my-2">
                        <div class="card-body">
                            <a
                                :href="
                                    '/users/' +
                                    user.id +
                                    '/' +
                                    user.display_name
                                "
                                >{{ user.display_name }}</a
                            >
                            <div v-if="user.profile_image_url">
                                <img
                                    class="avatar-img"
                                    :src="user.profile_image_url"
                                    alt="avatar"
                                />
                            </div>
                            <div>
                                <p>reputation: {{ user.reputation }}</p>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            created {{ user.created_at }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="search != ''">
                <div
                    class="col-sm-12 col-md-6 col-lg-3"
                    v-for="user in searchUsers"
                    :key="'searchuser' + user.id"
                >
                    <div class="card text-center my-2">
                        <div class="card-body">
                            <a
                                :href="
                                    '/users/' +
                                    user.id +
                                    '/' +
                                    user.display_name
                                "
                                >{{ user.display_name }}</a
                            >
                            <div v-if="user.profile_image_url">
                                <img
                                    class="avatar-img"
                                    :src="user.profile_image_url"
                                    alt="avatar"
                                />
                            </div>
                            <div>
                                <p>reputation: {{ user.reputation }}</p>
                                <p>location: {{ user.location }}</p>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            created {{ user.created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["users", "tab"],
    data() {
        return {
            currentTab: "Popular",
            showUsers: [],
            search: "",
            searchUsers: [],
        };
    },
    watch: {
        search: function (newVal) {
            this.searchUsers = [];

            if (newVal == "" || newVal == null) {
                document.getElementById("users-pagination").style.display =
                    "block";
                return;
            }

            document.getElementById("users-pagination").style.display = "none";

            this.debounceUsers();
        },
    },
    mounted() {
        this.showUsers = this.users.data;
        this.currentTab = this.tab;
        console.log("Component mounted.");
    },
    methods: {
        debounceUsers: _.debounce(function () {
            axios
                .get("/users/search", {
                    params: {
                        search: this.search,
                    },
                })
                .then((res) => {
                    console.log(res.data);
                    this.searchUsers = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        }, 500),
    },
};
</script>
