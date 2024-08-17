@extends('index')
@section('content')
<style>

    /* From Uiverse.io by Shoh2008 */ 
.checkbox-wrapper-8 .tgl {
  display: none;
}

.checkbox-wrapper-8 .tgl,
  .checkbox-wrapper-8 .tgl:after,
  .checkbox-wrapper-8 .tgl:before,
  .checkbox-wrapper-8 .tgl *,
  .checkbox-wrapper-8 .tgl *:after,
  .checkbox-wrapper-8 .tgl *:before,
  .checkbox-wrapper-8 .tgl + .tgl-btn {
  box-sizing: border-box;
}

.checkbox-wrapper-8 .tgl::-moz-selection,
  .checkbox-wrapper-8 .tgl:after::-moz-selection,
  .checkbox-wrapper-8 .tgl:before::-moz-selection,
  .checkbox-wrapper-8 .tgl *::-moz-selection,
  .checkbox-wrapper-8 .tgl *:after::-moz-selection,
  .checkbox-wrapper-8 .tgl *:before::-moz-selection,
  .checkbox-wrapper-8 .tgl + .tgl-btn::-moz-selection,
  .checkbox-wrapper-8 .tgl::selection,
  .checkbox-wrapper-8 .tgl:after::selection,
  .checkbox-wrapper-8 .tgl:before::selection,
  .checkbox-wrapper-8 .tgl *::selection,
  .checkbox-wrapper-8 .tgl *:after::selection,
  .checkbox-wrapper-8 .tgl *:before::selection,
  .checkbox-wrapper-8 .tgl + .tgl-btn::selection {
  background: none;
}

.checkbox-wrapper-8 .tgl + .tgl-btn {
  outline: 0;
  display: block;
  width: 4em;
  height: 2em;
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.checkbox-wrapper-8 .tgl + .tgl-btn:after,
  .checkbox-wrapper-8 .tgl + .tgl-btn:before {
  position: relative;
  display: block;
  content: "";
  width: 50%;
  height: 100%;
}

.checkbox-wrapper-8 .tgl + .tgl-btn:after {
  left: 0;
}

.checkbox-wrapper-8 .tgl + .tgl-btn:before {
  display: none;
}

.checkbox-wrapper-8 .tgl:checked + .tgl-btn:after {
  left: 50%;
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn {
  overflow: hidden;
  transform: skew(-10deg);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  transition: all 0.2s ease;
  font-family: sans-serif;
  background: #888;
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after,
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before {
  transform: skew(10deg);
  display: inline-block;
  transition: all 0.2s ease;
  width: 100%;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after {
  left: 100%;
  content: attr(data-tg-on);
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before {
  left: 0;
  content: attr(data-tg-off);
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active {
  background: #888;
}

.checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active:before {
  left: -10%;
}

.checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn {
  background: #86d993;
}

.checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:before {
  left: -100%;
}

.checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:after {
  left: 0;
}

.checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:active:after {
  left: 10%;
}
</style>
	<!-- container -->
    <div class="container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{__('route.Tables')}}</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{__('route.City')}}</span>
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
                                        <th class="wd-15p border-bottom-0"> {{__('route.first_name')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.last_name')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.phone')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.email')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.scope_work')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.active')}}</th>
                                        <th class="wd-15p border-bottom-0"> {{__('route.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                        
                                                <td>{{$item->first_name}}</td>
                                                <td>{{$item->last_name}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->userdetails->scopework->{'name_' . app()->getLocale()} }}</td>
                                                <td>
                                                    <div class="checkbox-wrapper-8">
                                                        <input type="checkbox" id="cb3-8" class="tgl tgl-skewed" data-id="{{$item->id}}" {{ $item->active ? 'checked' : '' }}>
                                                        <label for="cb3-8" data-tg-on="ON" data-tg-off="OFF" class="tgl-btn"></label>
                                                    </div>
                                                </td>
                                              
                                                <td>
                                                    
                                                
                                                    <a href="{{route('user.show',$item->id)}}" class="btn btn-info btn-sm" 
                                                        title="{{ trans('route.show') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                </td>
                                        </tr>
                                        
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tgl').on('change', function() {
                var userId = $(this).data('id');
                var active = $(this).is(':checked') ? 1 : 0;
    
                $.ajax({
                    url: '/users/update-active/'+ userId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        active: active
                    },
                    success: function(response) {
                      Swal.fire({
                            title: "Good job!",
                            text: "Modified successfully",
                            icon: "success"
                          });
                    },
                    error: function(response) {
                        alert('Failed to update user status!');
                    }
                });
            });
        });
    </script>


@endsection