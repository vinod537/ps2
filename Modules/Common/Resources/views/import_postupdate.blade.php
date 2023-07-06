<div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
        @if(Session::has('message'))
            <div class="alert alert-success">
               <strong>Success!</strong> {{ Session::get('message') }}
          </div>
        @endif

     <!-- Form -->
     <form method='POST' action="{{ route('importPostupdate') }}" enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file' required >
       <br>
       <input type='submit' name='submit' class='btn btn-primary' value='Update Category And Date'>
     </form>
</div>
</div>