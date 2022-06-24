@extends('layouts.app')

@section('content')


                <div class="panel-body" style="background-color: #FFFFFF;">
                    @if(Auth::user()->status == 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fa fa-ban"></i> System Executed Command Alert!</h5>
                            Plesase contact the administrator to activate your account.
                        </div>

                    @endif
                    <div align="center"><img src="{{asset('images/ultimex.jpg')}}" height="50%" width="50%"/></div>

                </div>
<style>
    body .container.body .right_col {
        background: #ffffff;
    }

    footer {
        background: #F7F7F7;

    }
</style>

@endsection
