@extends($theme.'layouts.user')
@section('title', trans($title))
@section('content')

<section class="payment-gateway mt-5 pt-5">
    <div class="container-fluid">
       <div class="row">
          <div class="col">
             <div class="header-text-full">
                <h2>@lang($title)</h2>
             </div>
          </div>
       </div>

       <div class="row profile-setting">
            <div class="col-md-3">
                <div class="card text-center bg-dark">
                    <ul class="list-group">
                        <li class="list-group-item font-weight-bold bg-transparent customborder">
                            <img
                                src="{{getFile(config('location.withdraw.path').optional($withdraw->method)->image)}}"
                                class="card-img-top w-50 pt-3" alt="{{optional($withdraw->method)->name}}">
                        </li>
                        <li class="list-group-item font-weight-bold list-text bg-transparent customborder text-white">@lang('Request Amount') :
                            <span
                                class="float-right text-success ">{{getAmount($withdraw->amount)}} {{@$basic->currency_symbol}}</span>
                        </li>
                        <li class="list-group-item font-weight-bold list-text bg-transparent customborder text-white">@lang('Charge Amount') :
                            <span
                                class="float-right text-danger">{{getAmount($withdraw->charge)}} {{@$basic->currency_symbol}}</span>
                        </li>
                        <li class="list-group-item font-weight-bold list-text bg-transparent customborder text-white">@lang('Total Payable') :
                            <span
                                class="float-right text-danger">{{getAmount($withdraw->net_amount)}} {{@$basic->currency_symbol}}</span>
                        </li>
                        <li class="list-group-item font-weight-bold list-text bg-transparent customborder text-white">@lang('Available Balance') :
                            <span
                                class="float-right text-success">{{@$basic->currency_symbol}}{{$remaining}} </span>
                        </li>
                    </ul>
                </div>

            </div>

        <div class="col-md-8">

            <div class="card card-type-1 bg-dark">
                <div class="card-header custom-header text-center borderBottom">
                    <h3 class="golden-text card-title pt-2">@lang('Additional Information To Withdraw Confirm')</h3>
                </div>

                <div class="card-body edit-area">

                    <form action="" method="post" enctype="multipart/form-data" class="form-row text-left preview-form">
                        @csrf
                        @if(optional($withdraw->method)->input_form)
                            @foreach($withdraw->method->input_form as $k => $v)
                                @if($v->type == "text")
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group mt-2">
                                            <label class="golden-text"><strong>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                        <span class="text-danger">*</span>  @endif</strong></label>
                                            <input type="text" name="{{$k}}"
                                                   class="form-control"
                                                   @if($v->validation == "required") required @endif>
                                            @if ($errors->has($k))
                                                <span
                                                    class="text-danger">{{ trans($errors->first($k)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($v->type == "textarea")
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="golden-text"><strong>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                        <span class="text-danger">*</span>  @endif
                                                </strong></label>
                                            <textarea name="{{$k}}" class="form-control" rows="2" @if($v->validation == "required") required @endif></textarea>
                                            @if ($errors->has($k))
                                                <span class="text-danger">{{ trans($errors->first($k)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @elseif($v->type == "file")

                                    <div class="col-md-12 mb-3">
                                        <label class="golden-text"><strong>{{trans($v->field_level)}} @if($v->validation == 'required')
                                                    <span class="text-danger">*</span>  @endif
                                            </strong></label>

                                        <div class="form-group mt-2">
                                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                     data-trigger="fileinput">
                                                    <img class="w-150px"
                                                         src="{{ getFile(config('location.default')) }}"
                                                         alt="...">
                                                </div>
                                                <div
                                                    class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                                                <div class="img-input-div">
                                                    <span class="btn btn-success btn-file">
                                                        <span
                                                            class="fileinput-new "> @lang('Select') {{$v->field_level}}</span>
                                                        <span
                                                            class="fileinput-exists"> @lang('Change')</span>
                                                        <input type="file" name="{{$k}}" accept="image/*"
                                                               @if($v->validation == "required") required @endif>
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput"> @lang('Remove')</a>
                                                </div>

                                            </div>
                                            @if ($errors->has($k))
                                                <br>
                                                <span
                                                    class="text-danger">{{ __($errors->first($k)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif


                        <div class="col-md-12">
                            <button type="submit" class="btn-custom w-100">
                                @lang('Confirm Now')
                            </button>
                        </div>

                    </form>
                </div>

            </div>


        </div>
    </div>
    </div>
</section>


@endsection



@push('css-lib')
    <link rel="stylesheet" href="{{asset($themeTrue.'css/bootstrap-fileinput.css')}}">
@endpush

@push('extra-js')
    <script src="{{asset($themeTrue.'js/bootstrap-fileinput.js')}}"></script>
@endpush

@push('script')

@endpush

