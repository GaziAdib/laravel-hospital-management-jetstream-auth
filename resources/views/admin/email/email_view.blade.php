@extends('admin.home')

@section('content')
<style>
    label{
        display: inline-block;
        width: 200px;
    }
</style>

    <div class="container justify-content-center mt-5 mb-5 pt-10">
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <form action="{{ route('store.doctors') }}" method="POST">
            @csrf
            <div class="pt-2 pb-2 mt-2">
                <label for="greeting">Greeting</label>
                <input type="text" style="color:black" name="greeting" placeholder="Enter greeting" required>
            </div>


            <div class="pt-2 pb-2 mt-2">
                <label for="body">Body</label>
                <input type="text" style="color:black" name="body" placeholder="Enter Body" required>
            </div>



            <div class="pt-2 pb-2 mt-2">
                <label for="actiontext">Action Text</label>
                <input type="text" style="color:black" name="actiontext" placeholder="Enter Action Text" required>
            </div>

            <div class="pt-2 pb-2 mt-2">
                <label for="actionurl">Action Url</label>
                <input type="text" style="color:black" name="actionurl" placeholder="Enter Action URL" required>
            </div>

            <div class="pt-2 pb-2 mt-2">
                <label for="endpart">End part</label>
                <input type="text" style="color:black" name="endpart" placeholder="Enter End Part" required>
            </div>


            <div class="pt-2 pb-2 mt-2">
                <input type="submit" class="btn btn-success">
            </div>

         </form>
    </div>


@endsection



