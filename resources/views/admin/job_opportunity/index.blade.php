@extends('index')
@section('content')

	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Job_Opportunity')}}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
              
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a type="button" class="btn btn-info btn-icon mr-2" class="modal-effect  btn-block" 
                         title="{{__('route.Add')}}" href="{{route('create.Job.Opportunity.admin')}}">
                        <i class="mdi mdi-plus"></i>
                       
                    </a>
                  
                </div>

               
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_arabic')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.name_english')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_opportunitys as $item)
                                        <tr>
                                        
                                                <td>{{$item->scopework->name_en}}</td>
                                                <td>{{$item->from_age}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#modaldemo8_edit{{ $item->id }}"
                                                        title="{{ trans('route.Edit') }}"><i class="fa fa-edit"></i>
                                                    </button>
                                                
                                                    <a href="{{route('city.destroy',$item->id)}}" class="btn btn-danger btn-sm" 
                                                        title="{{ trans('route.Delete') }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </td>
                                        </tr>
                                        @include('back.cities.edit')
                                    @endforeach
                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- /row -->
    </div>
    
    <!-- Container closed -->

   
   
@endsection