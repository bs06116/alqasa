<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar direction">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">


        <li class="treeview @if($dpage_id == 1) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الاقسام الرئيسية</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('generalDepartment.create') }}"><i class="far fa-dot-circle"></i> اضف قسم رئيسى </a></li>
            <li><a href="{{ route('generalDepartment.index') }}"><i class="far fa-dot-circle"></i> عرض الاقسام الرئيسية  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 2) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الدول</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('country.create') }}"><i class="far fa-dot-circle"></i> اضف دولة </a></li>
            <li><a href="{{ route('country.index') }}"><i class="far fa-dot-circle"></i> عرض الدول  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 4) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> المدن</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('city.create') }}"><i class="far fa-dot-circle"></i> اضف مدينة </a></li>
            <li><a href="{{ route('city.index') }}"><i class="far fa-dot-circle"></i> عرض المدن  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 5) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> المناطق</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('area.create') }}"><i class="far fa-dot-circle"></i> اضف منطقة </a></li>
            <li><a href="{{ route('area.index') }}"><i class="far fa-dot-circle"></i> عرض المناطق  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 9) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الشركات</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('department.create') }}"><i class="far fa-dot-circle"></i> اضف شركة </a></li>
            <li><a href="{{ route('department.index') }}"><i class="far fa-dot-circle"></i> عرض الشركات  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 13) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> المنتجات</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('product.create') }}"><i class="far fa-dot-circle"></i> اضف منتج </a></li>
            <li><a href="{{ route('product.index') }}"><i class="far fa-dot-circle"></i> عرض المنتجات  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 11) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> اكواد الخصومات</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('promoCode.create') }}"><i class="far fa-dot-circle"></i> اضف كود خصم </a></li>
            <li><a href="{{ route('promoCode.index') }}"><i class="far fa-dot-circle"></i> عرض اكواد الخصومات  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 12) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> المستخدمين</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.create') }}"><i class="far fa-dot-circle"></i> اضف مستخدم </a></li>
            <li><a href="{{ route('user.index') }}"><i class="far fa-dot-circle"></i> عرض المستخدمين  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 14) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> العملاء</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('client.create') }}"><i class="far fa-dot-circle"></i> اضف عميل </a></li>
            <li><a href="{{ route('client.index') }}"><i class="far fa-dot-circle"></i> عرض العملاء  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 15) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الحجوزات</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('reservation.index') }}"><i class="far fa-dot-circle"></i> عرض الحجوزات  </a></li>
          <li><a href="{{ route('reservation.show_delete') }}"><i class="far fa-dot-circle"></i> عرض الحجوزات المحذوفة  </a></li>
          </ul>
        </li>


        <li class="@if($dpage_id == 16) active @endif"><a href="{{route('setting.edit',1)}}"><i class="fab fa-elementor"></i> <span>اعدادات الموقع</span> </a></li>


        <!--
        <li class="@if($dpage_id == 11) active @endif"><a href="{{ route('message.index') }}"><i class="fa fa-envelope"></i> <span>الرسائل الداخلية</span> </a></li>

        <li class="@if($dpage_id == 13) active @endif"><a href="{{ route('social.index') }}"><i class="fa fa-laptop"></i> <span>وسائل التواصل الاجتماعى</span></a></li>

        -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
