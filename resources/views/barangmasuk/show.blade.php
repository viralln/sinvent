@extends('layouts.adm-main')


@section('content')
    <div class="container">
        <div class="pull-left">
            <h2>TAMPILKAN BARANG MASUK</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>TANGGAL MASUK</td>
                                <td>{{ $rsetBarang->tgl_masuk }}</td>
                            </tr>
                            <tr>
                                <td>QTY MASUK</td>
                                <td>{{ $rsetBarang->qty_masuk }}</td>
                            </tr>
                                
                                <tr>
				<td>BARANG</td>
                                <td>{{ $rsetBarang->barang->merk }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-12  text-center">
                <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection