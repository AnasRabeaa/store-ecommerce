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
                                        href="{{route('dashboard')}}">{{__('admin/index.Dashboard')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#"> {{__('admin/index.ADD')}}</a>
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
                                    @if($type === 'main-category' && $category && $category->count() > 0)
                                    <h4 class="card-title"
                                    id="basic-layout-form">{{__('admin/index.Add Main Category')}} </h4>
                                    @endif
                                    @if($type === 'sub-category' && $category && $category->count() > 0)
                                    <h4 class="card-title"
                                        id="basic-layout-form">{{__('admin/index.Add Sub Category')}} </h4>
                                    @endif
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
                                              action="{{route('store-category',$type)}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{--<input name="id" value="" type="hidden">--}}
                                            {{-- Start Category Data--}}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>
                                                    {{__('admin/index.Category Data')}}
                                                </h4>
                                                {{-- Start Category Slug And Name In Translations Table  --}}
                                                <div class="row">
                                                    {{--Start Category Image  --}}
                                                    <div class="form-group col-12">
                                                        <label> {{__('admin/index.Add Category Image')}} </label>
                                                        <br>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="image" value="">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    {{--End Category Image  --}}
                                                    {{-- Start Category Slug --}}
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            @if($type === 'main-category' && $category && $category->count() > 0)
                                                            <label
                                                                for="projectinput1">{{__('admin/index.Add New Category')}}</label>
                                                            @endif
                                                            @if($type === 'sub-category' && $category && $category->count() > 0)
                                                            <label
                                                                for="projectinput1">{{__('admin/index.Add New Sub Category')}}</label>
                                                            @endif
                                                            <input type="text" id="name" class="form-control"
                                                                   placeholder="  " value="{{old('slug')}}"
                                                                   name="slug">
                                                            @error('slug')
                                                            <span
                                                                class="text-danger">{{__('admin/index.This Field Is Required')}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--End Category Slug  --}}
                                                    {{--Start Category Name In Translations Table  --}}
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            @if($type === 'main-category' && $category && $category->count() > 0)
                                                            <label
                                                                for="projectinput1">{{__('admin/index.Add Category Name In Translation Table')}}</label>
                                                            @endif
                                                            @if($type === 'sub-category' && $category && $category->count() > 0)
                                                            <label
                                                                for="projectinput1">{{__('admin/index.Add Sub Category Name In Translation Table')}}</label>
                                                            @endif
                                                            <input type="text" id="nameTrans" class="form-control"
                                                                   value="{{old('name')}}"
                                                                   name="name">
                                                            @error('name')
                                                            <span
                                                                class="text-danger">{{__('admin/index.This Field Is Required')}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{--End Category Name In Translations Table  --}}
                                                    {{--Start Parent Category dropdown--}}
                                                    @if($type === 'sub-category' && $category && $category->count() > 0)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="projectinput2"> {{__('admin/index.Main Category')}} </label>
                                                                <select name="category_id" class="select2 form-control">
                                                                    <optgroup
                                                                        label="{{__('admin/index.Please Select a Main Category')}}">

                                                                        @foreach ($category as $cat)
                                                                            <option value="{{ $cat->id }}">
                                                                                {{$cat->slug}}
                                                                            </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                                @error('category_id')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    @endif
                                                    {{--End Parent Category dropdown--}}
                                                </div>
                                                {{--End Category Slug And Name In Translations Table   --}}
                                                {{--Start Category Status --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="status"
                                                                   id="switcheryColor4" class="switchery"
                                                                   checked data-color="success"/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">{{__('admin/index.Status')}}
                                                            </label>

                                                            @error('status')
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--End Category Status --}}
                                            </div>
                                            {{--End Category Data --}}
                                            {{-- Start Category Actions--}}
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{__('admin/index.Cancel')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{__('admin/index.Add')}}
                                                </button>
                                            </div>
                                            {{--End Category Actions --}}
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
