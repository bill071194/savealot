@extends('layouts.base')

@section('title', 'Admin')

@section('main')
<h1 class="h1 text-center">Cart</h1>
<div class="">
    <div class="col col-md-10 offset-md-1">
        <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
            <thead>
                <tr class="table-dark">
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>Salted Cashews</td>
                    <td>$12.99</td>
                    <td>1</td>
                    <td>$12.99</td>
                </tr>
                <tr>
                    <td>Unsalted Cashews</td>
                    <td>$12.99</td>
                    <td>2</td>
                    <td>$25.98</td>
                </tr>
                <tr id="tr03" class="">
                    <td id="id03Product">Yakisoba Chow Mein</td>
                    <td id="id03Price">$6.00</td>
                    <td id="id03Qty">2</td>
                    <td id="id03Total">$12.00</td>
                </tr>
            </tbody>
            <tbody class="table-group-divider">
                <tr>
                    <th colspan="3">Subtotal</th>
                    <th>$38.97</th>
                </tr>
                <tr>
                    <td colspan="2">Student Discount</td>
                    <td>-10%</td>
                    <td>($3.90)</td>
                </tr>
                <tr>
                    <td colspan="2">PST</td>
                    <td>7%</td>
                    <td>$2.73</td>
                </tr>
                <tr>
                    <td colspan="2">GST</td>
                    <td>5%</td>
                    <td>$1.95</td>
                </tr>
            </tbody>
            <tfoot class="table-group-divider">
                <tr class="table-success">
                    <th colspan="3">Subtotal:</th>
                    <th>$39.75</th>
                </tr>
            </tfoot>
        </table>
        <form action="" class="d-flex justify-content-end">
            <input type="hidden">
            <button class="btn btn-outline-success">Confirm Purchase</button>
        </form>
    </div>
</div>
@endsection
