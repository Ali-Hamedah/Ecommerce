@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Categories</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.product_categories.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new category</span>
                </a>
            </div>
        </div>

        @include('backend.product_categories.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Products count</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->parent != null ? $category->parent->name : '-' }}</td>
                        <td>{{ $category->status() }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.product_categories.edit', $category->id) }}"
                                   class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-danger"
                                        data-pro_id="{{ $category->id }}"
                                        data-product_name="{{ $category->name }}"
                                        data-toggle="modal"
                                        data-target="#modaldemo9">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </div>
                            <!-- delete -->
                            <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">حذف المنتج</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form
                                            action="{{ route('admin.product_categories.destroy', $category->id) }}"
                                            method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                <input type="hidden" name="pro_id" id="pro_id" value="">
                                                <input class="form-control" name="product_name" id="product_name"
                                                       type="text" readonly>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                    الغاء
                                                </button>
                                                <button type="submit" class="btn btn-danger">تاكيد</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No categories found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $categories->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
