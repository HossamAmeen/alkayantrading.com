@extends('admin.panel')

@section('content')
<!--Page main section start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">الاقسام</h3>
                    </div>

                    @if (session()->get('status') )
                        <div class="alert alert-success">
                            <strong>{{session()->get('status')}}</strong>
                        </div>
                    @endif

                    <div class="panel-body">
                        <div class="table-responsive ls-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الخدمه بالعربيه</th>
                                    <th>الخدمه بالانجليزي</th>
                                    <th>المستخدم</th>
                                    <th>action</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    ?>
                                    @foreach ($categories as $category)
                                    
                                   
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <a href="{{url('/admin/category/'.$category->id.'/edit')}}"
                                            
                                             aria-pressed="true">{{$category->ar_title}} </a>
                                    </td>
                                    <td>{{$category->en_title}}</td>
                                    <td> {{$category->name}} </td>
                                    <td >
                                            <form action="{{url('admin/category/'.$category->id ) }}" method="POST">
                                              {{ csrf_field() }}
                                              {{method_field('DELETE')}}
                                                <a href="{{url('/admin/category/'.$category->id.'/edit')}}" class="btn btn-info">Update</a>
                                          <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                            
                                    </td>
                                </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
        
        
                    </div>
                </div>
            </div>
        <!-- Main Content Element  Start-->
        </div>
    </div>
</section>

    <!--Right hidden  section end -->
    <div id="change-color">
        <div id="change-color-control">
            <a href="javascript:void(0)"><i class="fa fa-magic"></i></a>
        </div>
        <div class="change-color-box">
            <ul>
                <li class="default active"></li>
                <li class="red-color"></li>
                <li class="blue-color"></li>
                <li class="light-green-color"></li>
                <li class="black-color"></li>
                <li class="deep-blue-color"></li>
            </ul>
        </div>
    </div>
</section>

@endsection	  