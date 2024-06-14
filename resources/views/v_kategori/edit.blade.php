@extends('layouts.adm-main')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.update',$rsetKategori->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('nama',$rsetKategori->deskripsi) }}" placeholder="Masukkan deskripsi">
                           
                                <!-- error message untuk nama -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                               
                                <div class="form-check">
                                   
                                    <select class="form-select" name="kategori" aria-label="Default select example">
                                        @foreach($akategori as $key=>$val)
                                            @if($rsetKategori->kategori==$key)
                                                <option value="{{ $key }}" selected>{{ $val }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $val }}</option>
                                            @endif
                                        @endforeach
                                    </select>


                                </div>
                                <!-- error message untuk kategori -->
                                @error('kategori')
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