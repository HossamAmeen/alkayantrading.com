@extends('admin.panel')

@section('content')
<!--Page main section start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">المنتجات</h3>
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
                                    <th>المنتج بالعربيه</th>
                                    <th>المنتج بالانجليزي</th>
                                    <th>الشركه</th>
                                    <th>المستخدم</th>
                                    <th>القسم</th>
                                    <th>action</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    ?>
                                    @foreach ($products as $product)
                                    
                                   
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <a href="{{url('admin/products/'.$product->id.'/edit')}}"
                                            
                                             aria-pressed="true">{{$product->ar_title}} </a>
                                    </td>
                                    <td>{{$product->en_title}}</td>
                                    <th>{{$product->company_name}}</th>
                                   
                                    @if($product->user != null)
                                    <td>{{$product->user->name}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    
                                    @if($product->category != null)
                                    <td>{{$product->category->en_title}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td >
                                            <a href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-info">تحديث</a>
                                             <a href="{{url('/admin/products/delete/'.$product->id)}}" class="btn btn-danger check">حذف</a>
                                            {{-- <form action="{{url('admin/products/'.$product->id ) }}" method="POST">
                                              {{ csrf_field() }}
                                              {{method_field('DELETE')}}
                                        
                                             <button type="submit" class="btn btn-danger check">حذف</button>

                                            </form> --}}

                                            
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