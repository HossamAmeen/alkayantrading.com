@extends('layouts.panel')

@section('content')


<!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">إضافه منتج</h3>
                        </div>
                        <div class="panel-body">
                            <form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{url('admin/product')}}"
                                data-bv-message="This value is not valid"
                                data-bv-feedbackicons-valid="fa fa-check"
                                data-bv-feedbackicons-invalid="fa fa-bug"
                                data-bv-feedbackicons-validating="fa fa-refresh"
                                enctype="multipart/form-data"
                                >
                                {{csrf_field()}}   
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif  
                                 	 	 	
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">المنتج بالعربي</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="ar_title"
                                            data-bv-message="The service is not valid"
                                            required data-bv-notempty-message="The service is required and cannot be empty"
                                            value="{{ old('ar_title')}}"
                                            
                                                />
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">المنتج  بالانجليزي</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="en_title"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{ old('en_title')}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">الشركه</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="company_name"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{ old('company_name')}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">category</label>
                                        <div class="col-lg-6">
                                           <select name="category_id">

                                            @foreach ($categories as $category)
                                           <option value="{{$category->id}}">{{$category->en_title}}</option>  
                                            @endforeach
                                            
                                           </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary">Sign up</button>
                                    </div>
                                </div>
                            </form>
            
            
                        </div>
                    </div>
                </div>
            <!-- Main Content Element  Start-->
            </div>
        </div>
    </section>

<!--Page main section end -->

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