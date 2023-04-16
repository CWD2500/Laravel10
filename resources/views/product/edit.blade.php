@extends('product.layouts')


@section('content')
<div class="container mt-5 ">
  <div class="row">
  <div class="col- align-self-start">
        <a class="btn btn-outline-info  "   href="{{ route('index')  }}"  >  Home</a>
     </div>


     @if($errors->any() )
     <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $items)
                    <li>
                        {{$items}}
                    </li>
                    @endforeach
                </ul>
            </div>

            @endif


     <form action="{{route('update' , $product->id)}}" method="post" class="mt-4" enctype="multipart/form-data">
      @method("PUT")
        @csrf
        <div class="mb-3">
        <label for="#name" class="form-label">Name </label>
        <input type="text" class="form-control" name="name" id="#name" placeholder="Enter Name" value="{{$product->name}}">
        </div>
         <div class="mb-3">
        <label for="#Pictuer" class="form-label">Pictuer </label>
        <input type="file" class="form-control" name="image" id="#Pictuer" value="{{$product->image}}">
        </div>
        <div class="mb-3">
        <label for="#Details" class="form-label">Details</label>
        <textarea class="form-control" name="details" id="#Details" rows="3">
          {!!  $product->details  !!}
        </textarea>
        </div>
        <div class="mb-3">
              <button  class="btn btn-outline-info w-100"  type="submit"> Create Data Now     </button>
        </div>

     </form>



  </div>
</div>

@endsection