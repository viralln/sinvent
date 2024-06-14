@extends('layouts.adm-main')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
		<div class="pull-left">
		    <h2>DAFTAR BARANG MASUK</h2>
		</div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

	@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

	<div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 bg-light text-left">
                                <a href="{{ route('barangmasuk.create') }}" class="btn btn-success btn-sm">TAMBAH</a>
                            </div>
                            <div class="col-md-6 bg-light text-right">
                                <form action="/barangmasuk" method="GET" class="form-inline d-inline-block mw-100 navbar-search">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL MASUK</th>
                            <th>QTY MASUK</th>
                            <th>BARANG</th>
			<th style="width: 15%">AKSI</th>


	
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetBarang as $rowbarang)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $rowbarang->tgl_masuk  }}</td>
                                <td>{{ $rowbarang->qty_masuk  }}</td>
                                <td>{{ $rowbarang->barang->merk  }}</td>
                                
				<td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $rowbarang->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
					<a href="{{ route('barangmasuk.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                               
 
                            </tr>
                        @empty
                            <div class="alert">
                                Data barang masuk belum tersedia!
                            </div>
                        @endforelse
                    </tbody>
                   
                </table>
                {!! $rsetBarang->links('pagination::bootstrap-5') !!}

            </div>
        </div>
    </div>
@endsection