@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin/index.Dashboard')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('dashboard')}}">{{__('admin/index.Dashboard')}}</a>
                                </li>
                                @if($type === 'main-category')
                                <li class="breadcrumb-item active"> {{__('admin/index.Main Categories')}}
                                    </li>
                                @endif()
                                @if($type === 'sub-category')
                                <li class="breadcrumb-item active"> {{__('admin/index.Sub Categories')}}
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    @if($type === 'main-category')
                                    <h4 class="card-title">{{__('admin/index.All Main Categories')}} </h4>
                                    @endif()
                                    @if($type === 'sub-category')
                                    <h4 class="card-title">{{__('admin/index.All Sub Categories')}} </h4>
                                    @endif()
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
                                {{-- Start Alers --}}
                                    @include('dashboard.includes.alerts.success')
                                    @include('dashboard.includes.alerts.errors')
                                {{-- End Alers --}}

                                {{--Start Main Category--}}
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            {{--Start Table Head--}}
                                            <thead class="">
                                            <tr>
                                                <th>{{__('admin/index.Section')}} </th>
                                                @if($type === 'sub-category')
                                                <th>{{__('admin/index.Main Category')}}</th>
                                                @endif()
                                                <th> {{__('admin/index.Language')}}</th>
                                                <th>{{__('admin/index.Status')}}</th>
                                                <th>{{__('admin/index.Category Image')}}</th>
                                                <th>{{__('admin/index.Actions')}}</th>


                                            </tr>
                                            </thead>
                                            {{--End Table Head--}}
                                            {{--Start Table Head--}}
                                            <tbody>

                                            @isset($categories)
                                                @foreach($categories as $cat)
                                                    <tr>

                                                        <td>{{$cat->slug}}</td>
                                                        @if($type === 'sub-category')
                                                        <td>{{$cat->parent->name}}</td>
                                                        @endif()
                                                        <td>{{$cat->is_translatable == 1 ? 'EN & AR' : 'EN'}}</td>
                                                        <td>{{$cat->is_active == true ? 'Active' : 'Not active'}}</td>
                                                        <td><img style="width: 150px; height: 100px;"
                                                        src="{{asset('assets/images/categories/'.$cat->photo)}}">
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                        aria-label="Basic example">
                                                        {{--Update Link--}}
                                                        <a href="{{route('view-update-category',$cat->id)}}"
                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                        {{__('admin/index.Update')}}
                                                    </a>
                                                    {{--Delete Link--}}
                                                    <a href="{{route('delete-category',$cat->id)}}"
                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                    {{__('admin/index.Delete')}}
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                            {{--End Table Head--}}
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                                {{--End Main Category--}}
                                {{--End Sub Category--}}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
