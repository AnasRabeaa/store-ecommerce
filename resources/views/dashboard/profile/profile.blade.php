



@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="container mt-6" style="background-color: #fff;">
        <div class="card-content collapse show">
            <div class="card-body">
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
                @if(Session::has('notMatch'))
                    <div class="row mr-2 ml-2">
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                id="type-error">{{Session::get('notMatch')}}
                        </button>
                    </div>
                @endif
                <form class="form" method="POST" action="{{route('update-admin-profile',$admin->id)}}"
                      enctype="multipart/form-data">
                    <input type="hidden" value="" id="latitude" name="latitude">
                    <input type="hidden" value="" id="longitude" name="longitude">
                    <input type="hidden" value="" id="id" name="id">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <h3 style="display: contents;">{{__('admin/index.Edit Admin Profile')}}</h3>
                        <br> <br>
                        <input type="hidden" value="{{$admin->id}}" name="id">

                        {{--Start Admin Name Input--}}
                        <div class="row">
                            <div class=" col-xl-6 col-lg-6 col-md-6 ">
                                <div class="form-group">
                                    <label for="projectinput1"> {{__('admin/index.Admin Name')}} </label>
                                    <input type="text" id="pac-input" class="form-control"
                                           value="{{$admin->name}}" name="name">

                                    @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        {{--End Admin Name Input--}}
                        {{--Start Admin Email Input--}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="projectinput1">{{__('admin/index.Admin Email')}} </label>
                                    <input type="email" id="pac-input" class="form-control"
                                           value="{{$admin->email}}" name="email">

                                    @error('email')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        {{--End Admin Email Input--}}
                        </div>


                        <div class="row">
                            {{--Start Admin Current Password Input--}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="projectinput1">{{__('admin/index.Admin Current Password')}} </label>
                                    <input type="password" id="pac-input" class="form-control"
                                           name="currentPassword">
                                    @error('currentPassword')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{--End Admin Current Password Input--}}
                            {{--Start Admin New Password Input--}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="projectinput1">{{__('admin/index.Admin New Password')}} </label>
                                    <input type="password" id="pac-input" class="form-control"
                                           value="" name="newPassword">
                                    @error('newPassword')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            {{--End Admin New Password Input--}}
                            </div>

                        </div>
                        <div class="row">
                            {{--Start Admin Confirm New Password Input--}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="projectinput1">{{__('admin/index.Admin Confirm New Password')}} </label>
                                    <input type="password" id="pac-input" class="form-control"
                                           value="" name="confirmNewPassword">
                                    @error('confirmNewPassword')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{--End Admin Confirm New Password Input--}}
                            </div>
                        </div>

                        {{--Start Admin Photo--}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="projectinput1">{{__('admin/index.Admin Photo')}}</label> </label>
                                <br> <br>
                                <input type="file" id="exampleInputEmail1" aria-describedby="emailHelp" name="photo">
                                <br> <br>
                            </div>
                        {{--End Admin Photo--}

                    {{--End Status--}}
                    {{--<div id="map" style="height: 500px;width: 1000px;"></div>--}}
                    {{--Start Form Actions--}}
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1"
                                onclick="history.back();">
                            <i class="ft-x"></i> {{__('admin/index.Cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> {{__('admin/index.Submit')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>


    @stop
