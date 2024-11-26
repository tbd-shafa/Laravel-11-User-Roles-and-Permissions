
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Contact Us</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>


@session('success')
    <div class="alert alert-success" role="alert"> 
      {{ session('success') }}
    </div>
@endsession
 @if(session('error'))
 <div class="alert alert-danger" role="alert"> 
   {{ session('error') }}
    </div>
 @endif


 <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 d-flex">
                <label for="name"><span style="color:red">*</span>Name:</label><br>
                <input  style="width:100%;" type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>
                @error('name') <p style="color: red;">{{ $message }}</p> @enderror
            </div>
            <div class="col-md-6 d-flex">
                <label for="email"><span style="color:red">*</span>Email:</label><br>
                <input style="width:100%;" type="email" id="email" name="email" value="{{ old('email') }}" required><br><br>
                @error('email') <p style="color: red;">{{ $message }}</p> @enderror
            </div>
            <div class="col-md-12 d-flex mt-4">
                <label for="message"><span style="color:red">*</span>Message:</label><br>
                <textarea style="width:100%;" id="message" name="message" rows="5" required>{{ old('message') }}</textarea><br><br>
                @error('message') <p style="color: red;">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="col-md-12 d-flex mt-4">
         <button class="btn btn-success btn-sm mb-2 text-center" style="margin-left:624px; padding-left:42px; padding-right:42px; font-size:15px;" type="submit">Send</button>
        </div>
        
      
    
    </form>

@endsection