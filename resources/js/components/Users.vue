<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" @click="newModal()">
                                <i class="fa fa-user-plus"></i> Add
                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" v-show="!editmode">Create new User</h5>
                                    <h5 class="modal-title" id="exampleModalLabel1" v-show="editmode">Edit User Info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form @submit.prevent="editmode ? updateUser() :createUser()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input v-model="form.name" type="text" name="name"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Enter Name">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <input v-model="form.email" type="text" name="email"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Enter Email">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <input v-model="form.password" type="password" name="password"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"  placeholder="Enter Password">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                    <div class="form-group">
                                       <select name="type" v-model="form.type" id="type" class="form-control" :class="{'is-invalid': form.errors.has('type')}">
                                           <option value="">Select User Type</option>
                                           <option value="admin">Admin</option>
                                           <option value="user">User</option>
                                           <option value="otheruser">Other User</option>
                                       </select>
                                        <has-error :form="form" field="type"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <textarea v-model="form.bio" name="bio"
                                                  class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" placeholder="Enter Bio"></textarea>
                                        <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" v-show="!editmode" class="btn btn-primary">Save</button>
                                    <button type="submit" class="btn btn-success" v-show="editmode">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="user in users" >
                                <td>{{user.id}}</td>
                                <td>{{user.name | upText}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
                                <td>{{user.created_at | dateFormat}}</td>
                                <td>
                                    <a href="#" @click="editUser(user)">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
                editmode: false,
                users : {},
                form: new Form({
                    id: "",
                    name: "",
                    email: "",
                    password: "",
                    type: "",
                    bio: "",
                    photo: ""
                })
            }
        },
        methods: {
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addUser').modal('show');
            },

            editUser(user){
                this.editmode = true;
                this.form.reset();
                $('#addUser').modal('show');
                this.form.fill(user);
            },

            deleteUser(id){
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
                    this.form.delete('api/user/' +id).then(()=>{
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

            loadUsers(){
                axios.get('api/user').then(({ data }) => (this.users = data.data));
            },

            createUser() {
                this.$Progress.start();
                this.form.post('api/user')
                    .then(()=>{
                    Fire.$emit('afterCreate');
                    $('#addUser').modal('hide');

                    toast({
                        type: 'success',
                        title: 'Successfully Created'
                    });
                    this.$Progress.finish();
                })
                .catch(() => {

                })
            },

            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/' +this.form.id)
                    .then(()=>{
                    $('#addUser').modal('hide');
                toast({
                    type: 'success',
                    title: 'Info Update successfully.'
                });
                Fire.$emit('afterCreate');
                this.$Progress.finish();
            })
                .catch(()=>{
                    this.$Progress.fail();
                });

            }
        },
        mounted() {
            this.loadUsers();
            Fire.$on('afterCreate',() => {
               this.loadUsers();
            });
        }
    }
</script>
