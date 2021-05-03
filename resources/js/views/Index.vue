<template>
    <div>
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Categories</h2>
            <h3 class="section-subheading text-muted">Choose category</h3>
        </div>
        <spin v-if="loading"></spin>
        <div class="row" v-else>
            <category v-for="category in categories" :title="category.title" :imagePath="category.image"
                :key="category.id" :id="category.id"/>
        </div>
    </div>
</template>

<script>
    import Spin from "../components/Spin";
    import axios from "axios";
    import Category from "../components/Category";
    export default {
        components: {
            Spin,
            Category
        },
        data() {
            return {
                loading: true,
                categories: []
            }
        },
        mounted() {
            this.loadCategories();
        },
        methods: {
            loadCategories() {
                axios.get('api/categories')
                .then(response => {
                    this.categories = response.data;
                    this.loading = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>
