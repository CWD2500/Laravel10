@extends('product.layouts')


@section('content')


<div class="row">
     <div class="col- align-self-start">
        <a class="btn btn-priamry"  href="{{ route('create') }}" >  Create</a>
     </div>


    @if($message =Session::get('seccess'))
        <div class="alert alert-secodary"  roles="alert">
            {{$message}}
        </div>
    @endif


<table  class="table">
    <thead class="tabel-dark">
    <tr>
        <th>ID </th>
        <th>Iamge </th>
        <th>Name </th>
        <th>Details </th>
        <th width="300px">Action  </th>
    </tr>
    </thead>
        <tbody>
       
            @foreach ($pr_product as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>
                    <img src="/images/{{$items->image}}" alt="no Image" width="300px">  

                  </td>
                <td>{{$items->name}}</td>
                <td>{{$items->details}}</td>
                <td>
               
                    <form action="{{route('destroy' , $items->id )}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger "> Delete </button>
                    </form>
                 <a  class="btn btn-info" href="{{route('destroy' , $items->id )}}">Deletes</a>
                    <a  class="btn btn-info" href="{{ route('show' ,  $items->id) }}">Show</a>
            
        
                    <a class="btn btn-primary" href="{{ route('edit' ,  $items->id) }}">Edit</a>
       
                </td>

            </tr>
            @endforeach
        </tbody>
</table>
</div>
{!! $pr_product->links() !!}


@endsection