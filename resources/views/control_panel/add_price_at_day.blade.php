@extends('layouts.panel')

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
                    <div class="panel-body">
                        <div class="table-responsive ls-table">
                            <form id="defaultForm" method="POST" action="/admin/priceAtDay" class="form-horizontal ls_form" >
                                {{csrf_field()}}   
                            
                                    <?php
                                    $c=1;
                                    ?>
                                    <h3>select date</h3>
                                    <input class="form-control" name="day" type="date" >
                                    @foreach ($categories as $category)
                                    
                                    <table class="table">
                                        <thead>
                                        <tr>
                                                     
                                            <th>#</th>
                                            <th>المنتج</th>
                                            <th>سعر اليوم</th>
                                           
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h3> {{$category->en_title}} </h3>
                                        @if(!empty( $data['category'.$c] ))
                                        <?php $i=1; ?>
                                        @foreach ($data['category'.$c++] as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td >{{$item->en_title}}</td>
                                            <th> <input class="form-control" name="price[]" type="number" value="3"> </th>
                                            <th hidden><input class="form-control" name="product_id[]"   value="{{$item->id}}" > </th>
                                        </tr>
                                        @endforeach   
                                        @endif
                                    </tbody>
                                </table>                                         
                                   @endforeach
                                   
                            <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary">add</button>
                                    </div>
                                </div>
                            </form>
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


@endsection	  