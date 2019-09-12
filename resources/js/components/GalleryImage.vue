<template>
    <div class="col-12 col-sm-3 col-md-2">
        <div class="img-thumbnail mb-4">
            <div class="gallery-image"
                 :style="'background-image:url('+galleryPath+galleryItem.image+')'"
                 @click="swalMe(galleryItem)">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'gallery-image',
        props: ['item'],

        data () {
            return {
                galleryItem: JSON.parse(this.item),
                galleryPath: '/storage/img/gallery/',
            }
        },

        methods: {
            swalMe (item) {
                this.$swal({
                    imageUrl: this.galleryPath+item.image,
                    showConfirmButton: false,
                    showCloseButton: true,
                    imageClass: 'gallery-image-full',
                    title: item.title,
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
