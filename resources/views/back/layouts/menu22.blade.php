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

        <li class="treeview @if($dpage_id == 3) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> شركات التأمين</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('insuranceCompany.create') }}"><i class="far fa-dot-circle"></i> اضف شركة تأمين </a></li>
            <li><a href="{{ route('insuranceCompany.index') }}"><i class="far fa-dot-circle"></i> عرض شركات التأمين  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 6) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> التخصصات</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('specialty.create') }}"><i class="far fa-dot-circle"></i> اضف تخصص </a></li>
            <li><a href="{{ route('specialty.index') }}"><i class="far fa-dot-circle"></i> عرض التخصصات  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 7) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الرئيسية لمشاكل الحجز</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('reservationProblemDepartment.create') }}"><i class="far fa-dot-circle"></i> اضف قسم رئيسى لمشاكل الحجز </a></li>
            <li><a href="{{ route('reservationProblemDepartment.index') }}"><i class="far fa-dot-circle"></i> عرض الرئيسية لمشاكل الحجز  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 8) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> اقسام التمريض</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('nursingDepartment.create') }}"><i class="far fa-dot-circle"></i> اضف قسم تمريض </a></li>
            <li><a href="{{ route('nursingDepartment.index') }}"><i class="far fa-dot-circle"></i> عرض اقسام التمريض  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 9) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الاقسام الرئيسية للعروض</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('offerDepartment.create') }}"><i class="far fa-dot-circle"></i> اضف قسم رئيسى للعروض </a></li>
            <li><a href="{{ route('offerDepartment.index') }}"><i class="far fa-dot-circle"></i> عرض الاقسام الرئيسية للعروض  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 10) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> الاقسام الفرعية للعروض</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('offerSubDepartment.create') }}"><i class="far fa-dot-circle"></i> اضف قسم فرعى للعروض </a></li>
            <li><a href="{{ route('offerSubDepartment.index') }}"><i class="far fa-dot-circle"></i> عرض الاقسام الفرعية للعروض  </a></li>
          </ul>
        </li>

        <li class="treeview @if($dpage_id == 13) active @endif">
          <a href="#">
            <i class="fa fa-th"></i> <span> العروض</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('offer.create') }}"><i class="far fa-dot-circle"></i> اضف عرض </a></li>
            <li><a href="{{ route('offer.index') }}"><i class="far fa-dot-circle"></i> عرض العروض  </a></li>
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






        <!--
        <li class="@if($dpage_id == 11) active @endif"><a href="{{ route('message.index') }}"><i class="fa fa-envelope"></i> <span>الرسائل الداخلية</span> </a></li>

        <li class="@if($dpage_id == 13) active @endif"><a href="{{ route('social.index') }}"><i class="fa fa-laptop"></i> <span>وسائل التواصل الاجتماعى</span></a></li>

        <li class="@if($dpage_id == 14) active @endif"><a href="{{route('setting.edit',1)}}"><i class="fab fa-elementor"></i> <span>اعدادات الموقع</span> </a></li>
        -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>