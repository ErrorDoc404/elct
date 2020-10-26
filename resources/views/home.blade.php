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
                    @foreach ($users as $key => $user)
                      <div class="users users-{{ $user['id'] - 1 }}" id="user-{{ $user['id'] - 1 }}">{{ $user['name'] }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script>
    $(function(){
      let user_id = "{{ auth()->user()->id - 1 }}";
      let ip_address = "{{ env('APP_URL') }}";
      let socket_port = '3000'
      let socket = io(ip_address + ":" + socket_port);

      socket.on('connect', function(){
        socket.emit('user_connected',user_id);
      });

      socket.on('updateUserStatus', function(data) {
        $('.users').removeClass('online');
        $('.users').addClass('offline');
        $('.users').attr('title', 'away');
        $.each(data, function(key, value){
          if(value !== null && value !== 0){
            $('#user-'+key).addClass('online');
            $('#user-'+key).removeClass('offline');
          }
        });
      });


    });
  </script>
@endpush
