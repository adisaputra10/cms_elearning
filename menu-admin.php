<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nama; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <?php echo $level; ?></li>
            <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-th"></i> <span>Master </span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=userm"><i class="fa fa-circle-o"></i>User Management</a></li>
                <li><a href="index.php?view=user"><i class="fa fa-circle-o"></i>User List</a></li>
          
            
          
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-send"></i> <span>Tenant</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=tenant"><i class="fa fa-circle-o"></i>Tenant List</a></li>
                <li><a href="index.php?view=tenant&act=tambah"><i class="fa fa-circle-o"></i>Add New Tenant</a></li>
          
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-send"></i> <span>School</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="index.php?view=schoolist"><i class="fa fa-circle-o"></i>School List</a></li>
                <li><a href="index.php?view=schoolist&act=tambah"><i class="fa fa-circle-o"></i>Add New School</a></li>
          
              </ul>
            </li>

            
 
         
          </ul>
        </section>