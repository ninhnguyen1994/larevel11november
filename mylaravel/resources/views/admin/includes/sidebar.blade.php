 <!-- sidebar: style can be found in sidebar.less -->
 <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
         <div class="pull-left image">
             <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
             <p>{{ auth()->user()->name }}</p>
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
     </div>
     <!-- search form -->
     <form action="#" method="get" class="sidebar-form">
         <div class="input-group">
             <input type="text" name="q" class="form-control" placeholder="Search...">
             <span class="input-group-btn">
                 <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                         class="fa fa-search"></i>
                 </button>
             </span>
         </div>
     </form>
     <!-- /.search form -->
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
         <li class="header">DANH MỤC</li>
         <li class="">
            <a href="{{ route('admin') }}">
                <i class="fa fa-bar-chart-o"></i> <span>Thống kê</span>
            </a>
        </li>
         <li class="active treeview">
             <a href="#">
                 <i class="fa fa-group"></i> <span>Danh sách khách hàng</span>
                 <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                 </span>
             </a>
             <ul class="treeview-menu">
                 <li class="active"><a href="{{ route('admin.customers') }}"><i class="fa fa-circle-o"></i>
                         Danh
                         sách</a></li>
             </ul>
         </li>
         <li class="active treeview">
             <a href="#">
                 <i class="fa fa-user"></i> <span>Quản lý tài khoản</span>
                 <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                 </span>
             </a>
             <ul class="treeview-menu">
                 <li class="active"><a href="{{ route('admin.users') }}"><i class="fa fa-circle-o"></i> Danh
                         sách</a></li>
             </ul>
         </li>
         <li class="active treeview">
             <a href="#">
                 <i class="fa fa-file-text-o"></i> <span>Danh sách sản phẩm</span>
                 <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                 </span>
             </a>
             <ul class="treeview-menu">
                 <li class="active"><a href="{{ route('auth.category') }}"><i class="fa fa-circle-o"></i> Danh
                         sách</a></li>
             </ul>
         </li>
         <li class="active treeview">
             <a href="#">
                 <i class="fa fa-calendar"></i> <span>Quản lí sản phẩm</span>
                 <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                 </span>
             </a>
             <ul class="treeview-menu">
                 <li class="active"><a href="{{ route('admin.products') }}"><i class="fa fa-circle-o"></i>
                         Danh
                         sách</a></li>
             </ul>
         </li>
         <li class="active treeview">
            <a href="#">
                <i class="fa fa-list-ul"></i> <span>Quản lí đơn hàng</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o"></i>
                        Danh
                        sách</a></li>
            </ul>
        </li>
         </li>
     </ul>
 </section>
 <!-- /.sidebar -->
