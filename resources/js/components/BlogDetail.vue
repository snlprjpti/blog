<template>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Blog Details</div>

                    <div class="card-body">
                        {{blog.title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                id: null,
                blog :{
                    id:'',
                    title:'',
                    description:'',
                    published_date:'',
                    user_id:'',
                }
            }
        },
        methods:{
            loadBlog(){
                let id = this.$route.params.id;
                axios.get('api/blogs/' + id).then(({ data }) => (this.blog = data));
            },
        },
        mounted() {
            this.loadBlog();
        }
    }
</script>
