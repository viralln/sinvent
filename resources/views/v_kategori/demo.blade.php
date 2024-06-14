@extends('layouts.master')

@section('content')
@forelse ($rsetCategory as $rowCategory)
	{{ $rowCategory->id }}
	{{ $rowCategory->deskripsi }}
	{{ $rowCategory->kategori }}
	<br>
@empty
	{{ "Kosong" }}
@endforelse
@endsection