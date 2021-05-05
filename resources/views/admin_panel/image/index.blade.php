@extends('layouts.admin_layout')

@section('title', 'List Images')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Images</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 5%">
                                ID
                            </th>
                            <th>
                                Title
                            </th>
                            <th style="width: 30%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($images as $image)
                            <tr>
                                <td>
                                    {{ $image->id }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="" style="max-width: 300px">
                                </td>
                                <td>
                                    {{ $image->title }}
                                </td>
                                <td>
                                    {{ $image->description }}
                                </td>
                                <td>
                                    {{ $image->keywords }}
                                </td>
                                @role('admin')
                                <td class="project-actions text-right">
                                    <form action="{{ route('imageApprove', $image->id) }}" method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fas fa-check-circle"></i>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('imageDecline', $image->id) }}" method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="far fa-times-circle"></i>
                                            Decline
                                        </button>
                                    </form>
                                </td>
                                @endrole
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="mb-2">
            <div class="card-body">
                {{ $images->links() }}
            </div>
            <hr class="mb-0">
        </div>
    </section>
@endsection
