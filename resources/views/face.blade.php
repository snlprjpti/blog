<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <link rel="stylesheet" href="/css/app.css">
    <style>
        .picture-container {
            position: relative;
            width: 600px;
            height: auto;
            margin: 20px auto;
            border: 10px solid #fff;
            box-shadow: 0 5px 5px #000;
        }
        .picture {
            display: block;
            width: 100%;
            height: auto;
        }

        .face {
            position: absolute;
            border: 2px solid #FFF;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Blog</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="img/profile.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt red"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    @can('isAdmin')

                        <li class="nav-item">
                            <router-link to="/users" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </router-link>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Profile
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/author" class="nav-link">
                            <i class="nav-icon fas fa-user-astronaut"></i>
                            <p>
                                Author
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/blogs" class="nav-link">
                            <i class="nav-icon fas fa-paper-plane"></i>
                            <p>
                                Blogs
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-comment"></i>
                            <p>
                                Messenger
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <form class="form-group">
            <input id="picture" type="file" name="image" class="form-control picture">
            <img src="" id="profile-img-tag" width="300px" />
            <button type="button" id="submit" class="btn-success">Upload</button>
        </form>






    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.

    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js">

</script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{url('face/jquery.facedetection.min.js')}}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#picture").change(function(){
        readURL(this);
    });
</script>
<script>
    /* global $ */
    $(function () {
        "use strict";

        $('#submit').click(function (e) {
            $('.face').remove();

            $('#profile-img-tag').faceDetection({
                complete: function (faces) {
                    console.log(faces);
                    $.ajax({
                       url:'faces/details',
                       type:'GET',
                        data: {id:faces},
                        success: function(faces)
                        {
                        }

                    });

                    for (var i = 0; i < faces.length; i++) {
                        $('<div>', {
                            'class':'face',
                            'css': {
                                'position': 'absolute',
                                'left':     faces[i].x * faces[i].scaleX + 'px',
                                'top':      faces[i].y * faces[i].scaleY + 'px',
                                'width':    faces[i].width  * faces[i].scaleX + 'px',
                                'height':   faces[i].height * faces[i].scaleY + 'px'
                            }
                        })
                            .insertAfter(this);
                    }
                },
                error:function (code, message) {
                    alert('Error: ' + message);
                }
            });
        });
        });
</script>
</body>
</html>
