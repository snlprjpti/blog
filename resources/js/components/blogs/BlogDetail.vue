<template>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link to="/blogs" class="btn btn-secondary btn-sm btn-flat" style="float:right"><i class="fa fa-arrow-left"></i></router-link>
                        Blog Details
                    </div>
                    <div class="card-body">
                        <b class="card-title">{{blog.title}}</b><br>
                        <span v-html="blog.description"></span>
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-clock"></i> Published At : {{blog.published_date|dateFormat}}<br>
                        <i class="fa fa-udser"></i> Author : {{blog.author.name}}
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
                axios.get('/api/blogs/' + id).then(({ data }) => (this.blog = data));
            },
        },
        mounted() {
            this.loadBlog();
        }
    }
</script>
