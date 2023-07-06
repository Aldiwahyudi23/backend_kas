 <!-- pengambil data untuk profile app -->
 <?php

    use App\Models\AccessProgram;
    use App\Models\DataWarga;
    use App\Models\FotoUser;
    use App\Models\LayoutAppUser;
    use App\Models\MenuFooter;
    use App\Models\ProfileApp;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

    $profile_app = ProfileApp::first();
    $warna_nav = LayoutAppUser::where('user_id', Auth::user()->id)->first();

    $profile_app = ProfileApp::first();
    $warna_menu = LayoutAppUser::where('user_id', Auth::user()->id)->first();
    $data_menu_footer = MenuFooter::where('is_active', 1)->get();

    $user = DataWarga::find(Auth::user()->data_warga_id);
    $foto = FotoUser::where('data_warga_id', $user->id)->where('is_active', 1)->first();

    ?>

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark" style="background-color: {{$warna_nav->navbar}};">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         @foreach($data_menu_footer as $data)
         <?php $access_program = AccessProgram::where('user_id', Auth::user()->id)->where('program_id', $data->program_id); ?>
         @if( $access_program->count() == 1)
         @if($data->kategori == 1)
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{Route($data->route_url->route_name)}}" class="nav-link" id="{{$data->nama}}">{{$data->nama}}</a>
         </li>
         @endif
         @endif
         @if($data->program_id == 0)
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{Route($data->route_url->route_name)}}" class="nav-link" id="{{$data->nama}}">{{$data->nama}}</a>
         </li>
         @endif
         @endforeach

         <li class="nav-item ">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                 <img src="{{ asset($profile_app->logo) }}" alt="" class=" img-circle " width="30px">
             </a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item">
             <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                 <i class="fas fa-search"></i>
             </a>
             <div class="navbar-search-block">
                 <form class="form-inline" action="{{Route('cari')}}" method="GET">
                     <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar" type="text" name="cari" placeholder="Cari Anggota Keluarga" aria-label="Search">
                         <div class="input-group-append">
                             <button class="btn btn-navbar" type="submit">
                                 <i class="fas fa-search"></i>
                             </button>
                             <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>
         <!-- Messages Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-comments"></i>
                 <span class="badge badge-danger navbar-badge">3</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Brad Diesel
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 John Pierce
                                 <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">I got your message bro</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 Nora Silvester
                                 <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">The subject goes here</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
             </div>
         </li>
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                 <i class="fas fa-th-large"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->