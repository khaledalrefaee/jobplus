@extends('index')
@section('content')

<!DOCTYPE HTML>
<head>
<style>
    textarea {
    pointer-events: none;
    user-select: none;
}

</style>
</head>

<body>
	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Form')}}</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.Add')}} {{__('route.Job_Opportunity')}}</span>
                </div>
            </div>
         
        </div>
        <!-- breadcrumb -->

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            <form action="{{ route('job_opportunity.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                
                                    <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                        <label class="form-label">{{__('route.scope_work')}}</label>
                                        <select name="scope_work_id" class="form-control select2" id="scope_work_id">
                                            <option value=""> </option>
                                            @foreach ($scopeWorks as $scopeWork)
                                                <option value="{{$scopeWork->id}}">
                                                    {{$scopeWork->name_en}} / {{$scopeWork->name_ar}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                        <label class="form-label">{{__('route.job_title')}}</label>
                                        <select name="job_title_id" class="form-control select2" id="job_title_id">
                                            <option value="">اختر العنوان الوظيفي</option>
                                        </select>
                                    </div>
                                
                                    <div class="control-group form-group col-6">
                                        <label class="form-label">{{__('route.gender')}}</label>
                                        
                                        <div style="display: flex; gap: 20px; align-items: center;">
                                            <label class="rdiobox" style="margin-right: 10px;">
                                                <input name="gender" type="radio" value="male"> 
                                                <span>{{__('route.male')}}</span>
                                            </label>
                                            
                                            <label class="rdiobox">
                                                <input name="gender" type="radio" value="female">
                                                <span>{{__('route.female')}}</span>
                                            </label>


                                            <label class="rdiobox">
                                                <input name="gender" type="radio" value="Does not matter">
                                                <span>{{__('route.Does not matter')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-lg-6 mg-b-20 mg-lg-b-0">
                                        <label class="form-label">{{__('route.City')}}</label>
                                        <select name="city_id" class="form-control select2" id="city_id">
                                            <option value=""> </option>
                                            @foreach ($city as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->name_en}} / {{$item->name_ar}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                              
    
                                    <div class="control-group form-group col-3">
                                        
                                        <label class="form-label">{{__('route.from_age')}} <span class="text-success">( {{__('route.optional')}} )</span> </label>
                                        <input type="number" class="form-control " name="from_age" value="{{old('from_age')}}" placeholder="20" min="10" max="100">
                                    </div>
    
                                    <div class="control-group form-group col-3">
                                        
                                        <label class="form-label">{{__('route.to_age')}} <span class="text-success">( {{__('route.optional')}} )</span></label>
                                        <input type="number" class="form-control " name="to_age" value="{{old('to_age')}}" placeholder="50" min="10" max="100">
                                    </div>
    
                                    <div class="control-group form-group col-6">
                                        <label class="form-label">{{__('route.educational_level')}}</label>
                                        <select name="educational_level" class="form-control select2" >
                                            <option value=""> </option>
                                                <option value="{{__('route.diploma')}}">
                                                    {{__('route.diploma')}}
                                                </option>
                                                <option value="{{__('route.Doctorate')}}">
                                                    {{__('route.Doctorate')}}
                                                </option>
                                                <option value="{{__('route.graduate')}}">
                                                    {{__('route.graduate')}}
                                                </option>
                                                <option value="{{__('route.Master')}}">
                                                    {{__('route.Master')}}
                                                </option>
                                           
                                        </select>
                                    </div>
    
                                    <div class="control-group form-group col-6">
                                        <label class="form-label">{{__('route.career_level')}}</label>
                                        <select name="career_level" class="form-control select2" >
                                            <option value=""> </option>
                                                <option value="{{__('route.student')}}">
                                                    {{__('route.student')}}
                                                </option>
                                                <option value="{{__('route.Junior')}}">
                                                    {{__('route.Junior')}}
                                                </option>
                                                <option value="{{__('route.senior')}}">
                                                    {{__('route.senior')}}
                                                </option>
                                                <option value="{{__('route.Manager')}}">
                                                    {{__('route.Manager')}}
                                                </option>
                                              
                                           
                                        </select>
                                    </div>
    
                                    <div class="control-group form-group col-6">
                                        <label class="form-label">{{__('route.years_experience')}}</label>
                                        <select name="years_experience" class="form-control select2" >
                                            <option value=""> </option>
                                            <option value="{{__('route.Does not matter')}}">
                                                {{__('route.Does not matter')}}
                                             </option>
    
                                                <option value="1 year">
                                                   1 year
                                                </option>
                                                <option value="2 year">
                                                    2 year
                                                 </option>
                                                 <option value="3 year">
                                                    3 year
                                                 </option>
                                                 <option value="4 year">
                                                    4 year
                                                 </option>
                                                 <option value="5 year">
                                                    5 year
                                                 </option>
                                                 <option value="6 year">
                                                    6 year
                                                 </option>
                                           
                                        </select>
                                    </div>
    
                                    <div class="control-group form-group mb-0 col-6">
                                        <label class="form-label">{{__('route.number_vacancies')}}</label>
                                        <input type="number" name="number_vacancies" class="form-control required" min="1" max="10" placeholder="Number of Vacancies">
                                    </div>
    
                                    <div class="control-group form-group col-6">
                                        <label class="form-label">{{__('route.rang_salary')}}</label>
                                        <select name="rang_salary" class="form-control " >
                                            <option value=""> </option>
                                                <option value="{{__('route.between')}} 1000 {{__('route.and')}} 2000">
                                                    {{__('route.between')}} 1000 {{__('route.and')}} 2000
                                                </option>
                                                <option value="{{__('route.between')}} 2000 {{__('route.and')}} 3000">
                                                    {{__('route.between')}} 2000 {{__('route.and')}} 3000
                                                </option>
                                                <option value="{{__('route.between')}} 3000 {{__('route.and')}} 4000">
                                                    {{__('route.between')}} 3000 {{__('route.and')}} 4000
                                                </option>
                                                <option value="{{__('route.between')}} 4000 {{__('route.and')}} 5000">
                                                    {{__('route.between')}} 4000 {{__('route.and')}} 5000
                                                </option>
                                                <option value="{{__('route.between')}} 5000 {{__('route.and')}} 6000">
                                                    {{__('route.between')}} 5000 {{__('route.and')}} 6000
                                                </option>
                                                <option value="{{__('route.between')}} 6000 {{__('route.and')}} 7000">
                                                    {{__('route.between')}} 6000 {{__('route.and')}} 7000
                                                </option>
                                                <option value="{{__('route.between')}} 7000 {{__('route.and')}} 8000">
                                                    {{__('route.between')}} 7000 {{__('route.and')}} 8000
                                                </option>
                                                <option value="{{__('route.between')}} 8000 {{__('route.and')}} 9000">
                                                    {{__('route.between')}} 8000 {{__('route.and')}} 9000
                                                </option>
                                           
                                        </select>
                                    </div>
    
    
                                    <div class="control-group form-group mb-0 col-6">
                                        <label class="form-label">{{__('route.address')}} <span class="text-success">( {{__('route.optional')}} )</span></label> 
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control required " placeholder="Address">
                                        </div>
                                    </div>
    
                                   
                                    <div class="control-group form-group mb-0 col-12">
                                        <label class="form-label">{{__('route.job_description')}} </label> 
                                        <div class="form-group">
                                            <textarea type="text" name="job_description" class="form-control required " rows="5" >{{__('route.job_description')}}</textarea>
                                        </div>
                                    </div>
    
                                    <div class="control-group form-group mb-0 col-12">
                                        <label class="form-label">{{__('route.requirements')}} </label> 
                                        <div class="form-group">
                                            <textarea type="text" name="requirements" class="form-control required " rows="5" >{{__('route.requirements')}}</textarea>
                                        </div>
                                    </div>
    
                                    <div class="control-group form-group mb-0 col-12">
                                        <label class="form-label">{{__('route.requirements_for_trainees')}} <span class="text-success">{{__('route.optional')}}</span></label> 
                                        <div class="form-group">
                                            <textarea type="text" name="requirements_for_trainees" class="form-control required " rows="5" >{{__('route.requirements_for_trainees')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary " type="submit">{{__('route.save')}}</button>
                                </div>
                            </form>
                          
                            
                  
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    <script src="https://cdn.tiny.cloud/1/8vpv48z8mqzocaa4oagm9ox2ry48qhgpu4jjunvnbjl9z4xi/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select[name="scope_work_id"]').on('change', function(){
                var scopeWorkId = $(this).val();
                if(scopeWorkId) {
                    $.ajax({
                        url: '/get/jobtitle/by/' + scopeWorkId,
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}'  
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data); // للتحقق من البيانات المستلمة
                            if (data.jobtitlebyid) {
                                var jobTitleSelect = $('select[name="job_title_id"]');
                                jobTitleSelect.empty();
                                jobTitleSelect.append('<option value="">اختر العنوان الوظيفي</option>');
                                $.each(data.jobtitlebyid, function(key, value){
                                    console.log(value); // للتحقق من كل عنصر من عناصر العنوان الوظيفي
                                    jobTitleSelect.append('<option value="'+ value.id +'">'+ value.name_en +' / '+ value.name_ar +'</option>');
                                });
                            } else {
                                console.error("الحقل 'jobtitlebyid' غير موجود في الاستجابة");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("حدث خطأ: " + error);
                        }
                    });
                } else {
                    $('select[name="job_title_id"]').empty();
                }
            });
        });
    </script>
    
    

    
<!-- Place the first <script> tag in your HTML's <head> -->

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    
    
</body>
@endsection