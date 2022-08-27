@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            {{-- Start Headlines --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{__('admin/index.Dashboard')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#"> {{__('admin/index.ADD')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{--End Headlines  --}}
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"
                                        id="basic-layout-form">{{__('admin/index.Add Brand')}} </h4>
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
                                {{--Start Alerts Includes--}}
                                <div class="col-8 mx-auto">
                                    @include('dashboard.includes.alerts.success')
                                    @include('dashboard.includes.alerts.errors')
                                </div>
                                {{--End Alerts Includes--}}
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('store-brand')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf

                                            {{-- Start Brands Data--}}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                    {{__('admin/index.Brand Data')}}
                                                </h4>

                                                <div class="row">
                                                    {{--Start Brand Image  --}}
                                                    <div class="form-group col-12">
                                                        <label> {{__('admin/index.Add Brand Image')}} </label>
                                                        <br>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="image" value="">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    {{--End Brand Image  --}}



                                                    {{--Start Brand Name  --}}
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">{{__('admin/index.Add New Brand')}}</label>
                                                            <input type="text" id="nameTrans" class="form-control"
                                                                   value="{{old('name')}}"
                                                                   name="name">
                                                            @error('name')
                                                            <span
                                                                class="text-danger">{{__('admin/index.This Field Is Required')}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--End Brand Name  --}}

                                                </div>
                                                {{--Start Brand Status --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="is_active"
                                                                   id="switcheryColor4" class="switchery"
                                                                   checked data-color="success"/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">{{__('admin/index.Status')}}
                                                            </label>

                                                            @error('is_active')
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--End Brand Status --}}
                                            </div>
                                            {{--End Brand Data --}}

                                            {{-- Start Brand Actions--}}
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('admin/index.Cancel')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__('admin/index.Add')}}
                                                </button>
                                            </div>
                                            {{--End Brand Actions --}}
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

@endsection
