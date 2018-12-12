<section id="left-navigation">
    <!--Left navigation user details start-->

    <!--Phone Navigation Menu icon start-->

    <!--Left navigation start-->
    <ul class="mainNav">
        <li @if($title == 'بيانات الموقع') class="active"  @endif >
            <a href="/admin/pref">
                <i class="fa fa-bullhorn"></i> <span>بيانات الموقع</span>
            </a>
        </li>
        <li >
            <a  href="#">
                <i class="fa fa-bar-chart-o"></i> <span>المستخدم</span>
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
        <li >
            <a  href="#">
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
            <a  href="#">
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
            <a  href="#">
                <i class="fa fa-bar-chart-o"></i> <span>المنتجات</span>
            </a>
            <ul>
                <li>
                    <a  @if($title == 'اضافه منتج') class="active"  @endif href="{{url('admin/product/create')}}">اضافه منتج</a>
                </li>
                <li>
                    <a @if($title == 'عرض المنتجات') class="active"  @endif  href="{{url('admin/product')}}">عرض المنتجات</a>
                </li>

            </ul>
        </li>

        <li >
            <a  href="{{url('admin/show_prices')}}">
                <i class="fa fa-bar-chart-o"></i> <span>أسعار مواد بناء</span>
            </a>

        </li>

    </ul>
    <!--Left navigation end-->
</section>