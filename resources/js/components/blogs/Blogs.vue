<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Blogs
                        <router-link :to="{name: 'createBlog'}" type="button" style="float:right" class="btn btn-primary">
                            <i class="fa fa-user-plus"></i> Add
                        </router-link>
                    </div>

                    <div class="card-body">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Published At</th>
                                    <th>Modify</th>
                                </tr>
                                <tr v-for="(blog,index) in blogs.data">
                                    <td>{{index}}</td>
                                    <td>{{blog.title | upText | strLimit }}</td>
                                    <td>{{blog.published_date | dateFormat}}</td>
                                    <td>
                                        <router-link :to="{name: 'blogView', params: {id: blog.id}}" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-eye"></i>
                                        </router-link>

                                        <router-link :to="{name: 'blogEdit', params:{id: blog.id}}"  class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-pen"></i>
                                        </router-link>

                                        <a href="#" @click="deleteBlog(blog.id)" class="btn btn-outline-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer">
                            <pagination :data="blogs" @pagination-change-page="getResults">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav" >Next &gt;</span>
                            </pagination>
                        </div>
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
              blogs :{}
          }
        },
        methods:{
            getResults(page = 1) {
                axios.get('api/blogs?page=' + page)
                    .then(response => {
                    this.blogs = response.data;
            });
            },
            loadBlogs(){
                axios.get('api/blogs').then(({ data }) => (this.blogs = data));
            },

            deleteBlog(id){
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.value){
                    axios.delete('api/blogs/' +id).then(()=>{
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                )
                    Fire.$emit('afterCreate');
                }).catch(()=>{
                        swal("failed", "Something went wrong","warning");
                })
                }
            })
            },
        },
        mounted() {
            this.loadBlogs();
            Fire.$on('afterCreate',() => {
                this.loadBlogs();
        });
        }
    }
</script>