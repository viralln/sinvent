@extends('layouts.adm-main')


@section('content')
    <div class="container">
        <div class="pull-left">
            <h2>TAMPILKAN BARANG</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>MERK</td>
                                <td>{{ $rsetBarang->merk }}</td>
                            </tr>
                            <tr>
                                <td>SERI</td>
                                <td>{{ $rsetBarang->seri }}</td>
                            </tr>
                                <td>SPESIFIKASI</td>
                                <td>{{ $rsetBarang->spesifikasi }}</td>
                            </tr>
                            </tr>
                                <td>STOK</td>
                                <td>{{ $rsetBarang->stok }}</td>
                            </tr>
                            </tr>
                                <td>KATEGORI</td>
                                <td>{{ $rsetBarang->kategori->deskripsi }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-12  text-center">
                <a href="{{ route('barang.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection