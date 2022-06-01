@extends('layouts.app')
<script src="{{ asset('js/make_transaction.js') }}" defer></script>
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">{{ __('Make Transaction') }}</div>
                    <div class="card-body ">

                        <form class="form-horizontal " method="post" action="{{ route('do-transaction') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <fieldset>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="origin_account">Origin Account</label>
                                    <div class="col-md-12">
                                        <select id="origin_account" name="origin_account" class="form-control">
                                            <option value="2">{{__('Select an account')}}</option>
                                            @foreach($active_accounts as $account)
                                                <option value="{{$account->id}}">{{$account->account_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="destination_account">Destination Account</label>
                                    <div class="col-md-12">
                                        <select id="destination_account" name="destination_account" class="form-control">
                                            <option value="2">{{__('Select an account')}}</option>
                                            @foreach($active_accounts as $account)
                                                <option value="{{$account->id}}">{{$account->account_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="amount">Amount</label>
                                    <div class="col-md-12">
                                        <input onfocusout="formatPrice(this.value)" onfocus="removeFormat(this.value)" id="amount" name="amount" type="text" placeholder="" class="form-control input-md" required="">
                                        <input  id="real_amount" name="real_amount" type="hidden" placeholder="" class="form-control input-md" required="">

                                    </div>
                                </div>
                                <br>
                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="make_transaction"></label>
                                    <div class="col-md-4">
                                        <button type="submit" id="make_transaction" name="make_transaction" class="btn btn-success">{{__('Transfer')}}</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
