@extends('admin.panel')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function getFilters(){
                var filters = {
//                country : $('#country').val(),
                    date : $('#mDate').val(),
                    // college: $('#college').val(),
                    // grade: $('#grade').val(),
                    // dept : $('#dept').val(),
                    // subject : $('#subject').val(),
                    // instructor : $('#instructor').val(),
                    // teach_year : $('#teach_year').val(),
                    // lang : $('#lang').val(),
                    // q : $('#q').val(),
                    // order : $('#order').val(),
                    // user_id :$('#user_id').val()
                }
                // console.log('test');
                // console.log(filters);
                return filters;
            }

            function update() {
                // $('#loading-modal').modal('toggle'); //init loading function
                var filters = getFilters();
                console.log(filters);
                //initialize filters
                urlFilters = "?";
                for (var key in filters) {
                    if (filters.hasOwnProperty(key) && filters[key]) {
                        urlFilters += "&" + key + "=" + encodeURIComponent(filters[key]);
                    }
                }
                console.log(urlFilters);
                //start loading
                $('#min-wrapper').load( urlFilters +' #main-content', function (){
//                $('#material-filter-form').removeClass('hidden');
//                     $('#loading-modal').modal('toggle'); //hide loading modal
                    // highlightFilter();
                    console.log('loading is done');
                });

                //
//            $('#search-form-w > form.row').removeClass('hidden');
                //set url
                window.history.pushState("object or string", "Title", urlFilters);
                //   console.log(urlFilters);
                //window.location.href = "/materials" + urlFilters;
            }//end update function




</script>
@section('content')

<section id="min-wrapper">

    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">أسعار مواد البناء</h3>
                    </div>
                    @if(!empty(session()->get('status')))
                    <div class="alert alert-success">
                        <strong></strong> {{session()->get('status')}}
                    </div>
                    @endif
                    <div class="panel-body">
                        <div class="table-responsive ls-table">
                            <a class="btn btn-primary" href="{{url('admin/exportExcel')}}" role="button">Download Excel
                                Template</a>
                            <form class="col-md-8" method="post" action="{{url('admin/upload')}}"
                                enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="custom-file col-md-6">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="excel">
                                </div>
                                <div class=" col-md-6">

                                    <input type="submit" value="حفظ الأسعار لليوم">
                                </div>
                            </form>
                            <form id="defaultForm" method="POST" action="{{url('admin/add_price')}}"
                                class="form-horizontal ls_form">
                                {{csrf_field()}}

                                <?php
                                    $c=1;
                                    ?>
                                <input onchange=update() class="form-control" name="day" type="date" id="mDate"
                                    value="{{$day}}">
                                {{-- @foreach ($categories as $category) --}}
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>المنتج</th>
                                            <th>سعر اليوم</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <h3> {{$category->ar_title}} </h3> --}}
                                        <?php $i= 1;?>
                                        @foreach ($products as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                        
                                            <td>{{$item['product']}}</td>
                                        
                                            {{-- <td>{{$item->price->price}}</td> --}}
                                            <td> <input class="form-control" name="price[]" type="number"
                                                    
                                                {{-- @if($item->price(-1) !== null) --}}
                                                value = "{{$item['price']}}"
                                        
                                                
                                                >
                                            </td>
                                        
                                            {{-- <th> <input class="form-control" name="price[]" type="number" 
                                                            @if (isset($item->price))
                                                            
                                                               
                                                            @else
                                                            value = "1"
                                                            @endif
                                                            > </th> --}}
                                            <th hidden><input class="form-control" name="products[]"
                                                    value="{{$item['id']}}"> </th>
                                        </tr>
                                        @endforeach
                                        {{-- @endforeach --}}
                                        <?php $c++;?>

                                    </tbody>
                                </table>
                                {{-- @endforeach --}}

                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary col-md-4">حفظ</button>
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