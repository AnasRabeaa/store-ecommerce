@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>

                                </li>
                                <li class="breadcrumb-item active">وسائل التوصيل
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل  وسيلة التوصيل </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.shippings.methods',$shippingMethod -> id)}}"
                                              method="PUT"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$shippingMethod -> id}}">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم </label>
                                                            <input type="text" value="{{$shippingMethod -> value}}" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name">

                                                            <span class="text-danger"></span>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر القسم </label>
                                                            <select name="category_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر القسم ">

                                                                            <option
                                                                                value=""></option>


                                                                </optgroup>
                                                            </select>

                                                            <span class="text-danger"> </span>

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الهاتف </label>
                                                            <input type="text" id="mobile"
                                                                   class="form-control"
                                                                   placeholder="  " name="mobile"
                                                              value="">


                                                            <span class="text-danger"> </span>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> ألبريد الالكتروني </label>
                                                            <input type="text" id="email"
                                                                   class="form-control"
                                                                   placeholder="  " name="email"
                                                                   value="">


                                                            <span class="text-danger"> </span>

                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">
                                                    <div class="class col-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة المرور  </label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   placeholder="  " name="password">


                                                            <span class="text-danger"> </span>

                                                        </div>

                                                    </div>
                                                </div>


                                                <di class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> العنوان  </label>
                                                            <input type="text" id="pac-input"
                                                                   class="form-control"
                                                                   placeholder="  " name="address"
                                                                   value=""
                                                            >


                                                            <span class="text-danger"> </span>

                                                        </div>
                                                    </div>

                                                </di>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked />
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>


                                                            <span class="text-danger"> </span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div id="map" style="height: 500px;width: 1000px;"></div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>


    @stop
