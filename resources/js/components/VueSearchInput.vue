<template>
    <div>
        <input
            class="form-control me-2"
            type="search"
            name="search"
            placeholder="Search"
            aria-label="Search"
            autocomplete="off"
            :value="oldvalue"
            @focus="openPopup = true"
            @blur="openPopup = false"
        />

        <div class="card card-search" v-if="openPopup">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div>
                            [tag]
                            <small class="text-muted"
                                >search within a tag</small
                            >
                        </div>
                        <div>
                            user:1234
                            <small class="text-muted">search by author</small>
                        </div>
                        <div>
                            "words here"
                            <small class="text-muted">exact phrase</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            answers:0
                            <small class="text-muted"
                                >unanswered questions</small
                            >
                        </div>
                        <div>
                            score:3
                            <small class="text-muted"
                                >posts with a 3+ score</small
                            >
                        </div>
                        <div>
                            isaccepted:yes
                            <small class="text-muted"
                                >search within status</small
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["oldvalue"],
    data() {
        return {
            openPopup: false,
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
