<template>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <router-link to="/blogs" class="btn btn-secondary btn-sm btn-flat" style="float:right"><i class="fa fa-arrow-left"></i></router-link>
                        Blog Edits
                    </div>
                    <div class="card-body">
                        <form v-on:submit="saveForm()">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Blog Title</label>
                                <input type="text" v-model="blog.title" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="control-label">Blog Description</label>
                                <vue-editor v-model="blog.description"></vue-editor>
                            </div>
                            <br>
                            <div class="col-md-12 form-group">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'
    export default {
        components: {
            VueEditor
        },
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
            saveForm(){
                this.$Progress.start();
                let id = this.$route.params.id;

                axios.put('api/blogs/' +this.$route.params.id, this.blog)
                    .then(()=>{
                toast({
                    type: 'success',
                    title: 'Info Update successfully.'
                });
                this.$Progress.finish();
            })
            .catch(()=>{
                    this.$Progress.fail();
            });

            }
        },
        mounted() {
            this.loadBlog();
        }
    }
</script>
