<section id="left-navigation">
    <!--Left navigation user details start-->

    <!--Phone Navigation Menu icon start-->

    <!--Left navigation start-->
    <ul class="mainNav">
        @if(session('role') == 1 )
        <li @if($title == 'اضافه بيانات الموقع' || ' تعديل بيانات الموقع') class="active"  @endif >
            <a href="{{url('admin/prefs')}}">
                <i class="fa fa-bullhorn"></i> <span>بيانات الموقع</span>
            </a>
        </li>
       
        <li >
            <a  href="#" @if($title == 'اضافه مستخدم' || $title == 'عرض المستخدمين') class="active"  @endif>
                <i class="fa fa-bar-chart-o"></i> <span>المستخدمين</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه مستخدم') class="active"  @endif href="{{url('admin/user/create')}}">اضافه مستخدم</a>
                </li>
                <li>
                    <a @if($title == 'عرض المستخدمين') class="active"  @endif  href="{{url('admin/user')}}">عرض المستخدمين</a>
                </li>

            </ul>
        </li>
        @endif 
        <li>
            <a @if($title == 'تعديل البيانات') class="active"  @endif  href="{{url('admin/user/'.session('id') .'/edit')}}">
                <i class="fa fa-bar-chart-o"></i> تعديل بيانات الحساب</a>
        </li>

        <li >
            <a  href="#" @if($title == 'اضافه قسم' || $title == 'عرض الاقسام') class="active"  @endif >
                <i class="fa fa-bar-chart-o"></i> <span>الاقسام</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه قسم') class="active"  @endif href="{{url('admin/category/create')}}">اضافه قسم</a>
                </li>
                <li>
                    <a @if($title == 'عرض الاقسام') class="active"  @endif  href="{{url('admin/category')}}">عرض الاقسام</a>
                </li>

            </ul>
        </li>
        <li >
            <a  href="#" @if($title == 'اضافه خدمه' || $title == 'عرض الخدمات') class="active"  @endif >
                <i class="fa fa-bar-chart-o"></i> <span>الخدمات</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه خدمه') class="active"  @endif href="{{url('admin/service/create')}}">اضافه خدمه</a>
                </li>
                <li>
                    <a @if($title == 'عرض الخدمات') class="active"  @endif  href="{{url('admin/service')}}">عرض الخدمات</a>
                </li>

            </ul>
        </li>
        <li >
            <a  href="#"  @if($title == 'اضافه منتج' || $title == 'عرض المنتجات') class="active"  @endif >
                <i class="fa fa-bar-chart-o"></i> <span>المنتجات</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه منتج') class="active"  @endif href="{{url('admin/products/create')}}">اضافه منتج</a>
                </li>
                <li>
                    <a @if($title == 'عرض المنتجات') class="active"  @endif  href="{{url('admin/products')}}">عرض المنتجات</a>
                </li>

            </ul>
        </li>
        <li >
            <a  href="#"  @if($title == 'اضافه عضو' || $title == 'عرض الاعضاء') class="active"  @endif >
                <i class="fa fa-bar-chart-o"></i> <span>فريق العمل</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه عضو') class="active"  @endif href="{{url('admin/team/create')}}">اضافه عضو</a>
                </li>
                <li>
                    <a @if($title == 'عرض الاعضاء') class="active"  @endif  href="{{url('admin/team')}}">عرض الاعضضاء</a>
                </li>

            </ul>
        </li>
        <li >
            <a  href="#"  @if($title == 'اضافه تعليق' || $title == 'عرض التعليقات') class="active"  @endif >
                <i class="fa fa-bar-chart-o"></i> <span>آراء العملاء</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه تعليق') class="active"  @endif href="{{url('admin/review/create')}}">اضافه رآي</a>
                </li>
                <li>
                    <a @if($title == 'عرض التعليقات') class="active"  @endif  href="{{url('admin/review')}}">عرض الآراء</a>
                </li>

            </ul>
        </li>

        <li >
            <a  href="{{url('admin/show_prices')}}">
                <i class="fa fa-bar-chart-o"></i> <span>أسعار مواد بناء</span>
            </a>

        </li>

        <li >
            <a  href="{{url('admin/logout')}}">
                <i class="fa fa-power-off"></i> <span>تسجيل خروج</span>
            </a>

        </li>


    </ul>
    <!--Left navigation end-->
</section>