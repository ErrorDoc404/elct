@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script>
    $(function(){
      let user_id = "{{ auth()->user()->id }}";
      let ip_address = '127.0.0.1';
      let socket_port = '3000'
      let socket = io(ip_address + ":" + socket_port);

      socket.on('connect', function(){
        socket.emit('user_connected',user_id);
      });

      socket.on('updateUserStatus', function(data) {
        $.each(data, function(key, value){
          if(value !== null && value !== 0){

          }
        });
      });
    });
  </script>
@endpush
