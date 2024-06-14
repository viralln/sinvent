@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
		<div class="pull-left">
		    <h2>TAMBAH BARANG KELUAR</h2>
		</div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangkeluar.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KELUAR</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar', $today) }}">
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if($errors->has('errtgl'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('errtgl') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">QTY</label>
                                <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="1" placeholder="Masukkan QTY">
                                @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @if($errors->has('errstok'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('errstok') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-control" name="barang_id" aria-label="Default select example">
                                    <option value="blank">Pilih Barang</option>
                                    @foreach ($abarang as $rowbarang)
                                        <option value="{{ $rowbarang->id  }}">{{ $rowbarang->merk  }} (Stok: {{ $rowbarang->stok }})</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection