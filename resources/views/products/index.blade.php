@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Website</h2>
            </div>
            {{-- <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product </a>
                @endcan
            </div> --}}
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Url</th>
            <th>Status</th>
            <th>Devices</th>
            <th>Publish</th>
            <th width="280px">Aksi</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->url }}</td>
	        <td>{{ $product->status == true ? 'Aktif' : 'Nonaktif' }}</td>
	        <td>{{ $product->os }}</td>
	        <td>{{ $product->created_at }}</td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}
                    @can('product-edit')
                    <a class="btn btn-sm btn-{{ $product->status == true ? 'success' : 'warning' }}" href="{{ route('products.edit',$product->id) }}">{{ $product->status == true ? 'Nonakfikan' : 'Aktifkan' }}</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
</div>

    {!! $products->links() !!}

@endsection
