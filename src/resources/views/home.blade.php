@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bank transfers') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <a href="{{route('make-transaction')}}" class="btn btn-primary">{{ __('Own account') }}</a>
                    <a href="{{route('make-external-transaction')}}" class="btn btn-secondary">{{ __('External account') }}</a>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Transactions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container mt-5">
                        <table class="table table-bordered mb-5">
                            <thead>
                            <tr class="table-success">
                                <th scope="col">#</th>
                                <th scope="col">{{__('Origin Account Number')}}</th>
                                <th scope="col">{{__('Destination Account Number')}}</th>
                                <th scope="col">{{__('Amount')}}</th>
                                <th scope="col">{{__('Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ $transaction->origin_account_number }}</td>
                                    <td>{{ $transaction->destination_account_number }}</td>
                                    <td>${{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ date('j F, Y', $transaction->created_at) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $transactions->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
