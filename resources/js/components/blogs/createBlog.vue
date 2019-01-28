<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <div class="card card-default">
                    <div class="card-header">Create Blog</div>

                    <div class="card-body">
                        <form v-on:submit="saveForm()">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Blog Title</label>
                                    <input type="text" v-model="blog.title" class="form-control" :class="{'is-invalid': blog.errors.has('title')}">
                                    <has-error :form="blog" field="title"></has-error>
                                </div>
                            <div class="col-md-12 form-group">
                                <label class="control-label">Blog Description</label>
                            <vue-editor v-model="blog.description"></vue-editor>
                                <has-error :form="blog" field="description"></has-error>
                            </div>
                            <br>
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-success">Create</button>
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
        data: function () {
            return {
                blog: new Form({
                    title: '',
                    description: '',
                })
            }
        },
        methods: {
            saveForm() {
                this.$Progress.start();
                var newBlog = this.blog;
                axios.post('/api/blogs', newBlog)
                    .then(function () {
                        toast({
                            type: 'success',
                            title: 'Successfully Created'
                        });

                })
//                this.$router.push({path: '/blogs'})
                    .catch(function (data) {
                        toast({
                            type: 'error',
                            title: 'Cannot Create'
                        });
                    });
                this.$Progress.finish();
            }
        },
        mounted() {

        }
    }
</script>
