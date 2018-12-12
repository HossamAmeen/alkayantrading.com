@extends('layouts.panel')

@section('content')


<!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">بيانات الموقع</h3>
                        </div>
                        <div class="panel-body">
                        <form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{url('admin/pref/' . $id)}}"
                                data-bv-message="This value is not valid"
                                data-bv-feedbackicons-valid="fa fa-check"
                                data-bv-feedbackicons-invalid="fa fa-bug"
                                data-bv-feedbackicons-validating="fa fa-refresh"
                                enctype="multipart/form-data"
                                >
                                {{csrf_field()}}
                                {{method_field('PUT')}}
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
                                    <label class="col-lg-3 control-label">العنوان بالعربيه</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="arAddress"
                                            data-bv-message="The service is not valid"
                                            required data-bv-notempty-message="The service is required and cannot be empty"
                                            value="{{ $arAddress}}"

                                                />
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">العنوان بالانجليزي</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="enAddress"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$enAddress}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">الوصف بالانجليزي</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="enDescription"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$enDescription}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">الوصف بالعربيه</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="arDescription"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$arDescription}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label"> الموبيل</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="phone"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$phone}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">  العنوان الرئيسي بالعربي</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="arMainAddress"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$arMainAddress}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">  العنوان الرئيسي بالانجليزي</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="enMainAddress"
                                            data-bv-message="The username is not valid"
                                            required data-bv-notempty-message="The username is required and cannot be empty"
                                            value="{{$enMainAddress}}"
                                                />
                                    </div>
                                 </div>
                                <div class="form-group">
                                <label class="col-lg-3 control-label">  الايميل الاساسي</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="mainEmail"
                                        data-bv-message="The username is not valid"
                                        required data-bv-notempty-message="The username is required and cannot be empty"
                                        value="{{$mainEmail}}"
                                            />
                                </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label">facebook account</label>
                                        <div class="col-lg-6">
                                            <input type="url" class="form-control" name="facebook"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$facebook}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label"> twitter account</label>
                                        <div class="col-lg-6">
                                            <input type="url" class="form-control" name="twitter"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$twitter}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label"> instagram account</label>
                                        <div class="col-lg-6">
                                            <input type="url" class="form-control" name="instagram"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$instgram}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-lg-3 control-label"> linkedin account</label>
                                        <div class="col-lg-6">
                                            <input type="url"  class="form-control" name="linkedin"
                                                data-bv-message="The username is not valid"
                                                required data-bv-notempty-message="The username is required and cannot be empty"
                                                value="{{$linkedin}}"
                                                    />
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <button type="submit" class="btn btn-primary">update</button>
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