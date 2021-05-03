<template>
    <div class="col-lg-4 col-sm-6 mb-4">
        <div class="portfolio-item">
            <router-link class="portfolio-link" data-toggle="modal" :to="getImageUrl(id)">
                <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                        <svg class="svg-inline--fa fa-plus fa-w-14 fa-3x" aria-hidden="true" focusable="false"
                             data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32
                            14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67
                            14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33
                            32-32v-32c0-17.67-14.33-32-32-32z"></path>
                        </svg>
                    </div>
                </div>
                <img class="img-fluid" :src="getImageSrc(imagePath)" alt="">
            </router-link>
            <div class="portfolio-caption">
                <div class="portfolio-caption-heading">{{ title }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String
            },
            imagePath: {
                type: String
            },
            id: {
                type: Number
            }
        },
        methods: {
            getImageSrc(imagePath) {
                return "/storage/" + imagePath;
            },
            getImageUrl(id) {
                return "/image/" + id;
            }
        }
    }
</script>

<style scoped>

</style>
