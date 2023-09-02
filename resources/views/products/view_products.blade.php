<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <h1>products</h1>
    <div>
         @if (session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <a href="{{route('products.add_products')}}">Add a Product</a>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->qty}}</td>
                        <td>
                            <a href="{{route('products.edit_products', ['product' => $product->id])}}">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{route('products.delete_products', ['product' => $product->id])}}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>

<style>
    table {
        border-collapse: collapse;
        width: 50%;
    }

    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }
</style>