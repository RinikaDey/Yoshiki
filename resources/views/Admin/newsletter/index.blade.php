@extends('layouts.admin')



@section('content')
   <div class="card">
    <div class="card-header">
        <h4>Newsletter Page</h4>
        <form method="POST" action="{{url('send-newsletter')}}">
            @csrf
        <input type="text"
               name="subject"
               class="form-control mb-3 border border-dark p-2"
               placeholder="Enter subject">

        <textarea name="message"
                  class="form-control mb-3 border border-dark p-2"
                  rows="5"
                  placeholder="Write your newsletter message..."></textarea>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                <i class="material-icons align-middle">send</i>
                Send Newsletter
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-fixed table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsletter as $item)    
                <tr>
                    <td >{{$item->id}}</td>
                    <td >{{$item->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   </div>
@endsection