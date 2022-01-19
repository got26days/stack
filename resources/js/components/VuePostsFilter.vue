<template>
    <div>
        <div class="d-flex w-100 justify-content-end">
            <button
                class="btn btn-primary"
                :class="{ active: openFilter }"
                @click="toggle()"
                type="button"
            >
                Open Filter
            </button>
        </div>
        <div class="py-2" v-if="openFilter">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Filters</h5>
                </div>

                <div class="card-body">
                    <div>
                        <label for="exampleInputEmail1" class="form-label"
                            >The following tags:</label
                        >

                        <tags-input
                            element-id="tags"
                            v-model="selectedTags"
                            class="tagsSelector"
                            wrapper-class="form-control"
                            :existing-tags="searchTags"
                            :typeahead="true"
                            id-field="id"
                            @change="onChange"
                        >
                            <template
                                v-slot:selected-tag="{ tag, index, removeTag }"
                            >
                                <span v-html="tag.value"></span>

                                <a
                                    href="#"
                                    class="tags-input-remove"
                                    @click.prevent="removeTag(index)"
                                    >X</a
                                >
                            </template>
                        </tags-input>
                    </div>
                </div>

                <div class="card-body">
                    <a
                        type="submit"
                        class="btn btn-primary"
                        :href="'/questions/tagged/' + tagsLine + params"
                    >
                        Apply
                    </a>
                    <a href="#" class="card-link" @click="toggle()">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VoerroTagsInput from "@voerro/vue-tagsinput";
import axios from "axios";

export default {
    props: ["selectedBackTags"],
    components: { "tags-input": VoerroTagsInput },
    data() {
        return {
            openFilter: true,
            selectedTags: [],
            searchInput: "",
            searchTags: [],
            params: "",
        };
    },
    mounted() {
        if (this.selectedBackTags.length > 0) {
            this.selectedBackTags.forEach((elem) => {
                this.selectedTags.push({
                    value: elem,
                    id: -1,
                });
            });
        }
        this.params = window.location.search;
    },
    watch: {
        searchInput: function () {
            this.debounceInput();
        },
    },
    computed: {
        tagsLine() {
            if (this.selectedTags.length == 0) return "";
            let tags = this.selectedTags.map((elem) => {
                return elem.value;
            });

            return tags.join(" ");
        },
    },
    methods: {
        toggle() {
            this.openFilter = !this.openFilter;
        },
        debounceInput: _.debounce(function () {
            let idsArray = this.selectedTags.map((elem) => {
                return elem.value;
            });
            axios
                .get("/tags/search", {
                    params: {
                        tag: this.searchInput,
                        tags_selected: idsArray,
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
        onChange(value) {
            if (value == null || value == "") return;
            this.searchInput = value;
        },
    },
};
</script>
