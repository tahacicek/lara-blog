<x-app-layout>
    @section('title', 'Kategori')
    @section('css')
    @endsection
    <div class="main-wrapper">
        <div class="main-wrapper">
            <h3 class="text-white">Kategoriler</h3>
            <div class="py-3"></div>
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <button data-bs-toggle="modal" data-bs-target="#createCategory" class="btn btn-success me-2"
                            id="createCategories"> Oluştur <i class="fa fa-check" aria-hidden="true"></i></button>
                        <button class="btn btn-warning text-dark"> Geri Dönüşüm <i class="fa fa-trash"
                                aria-hidden="true"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="categoryTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Kategori Adı</th>
                                <th>Slug</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="orders">
                            @foreach ($categories as $category)
                                <tr id="{{ $category->id }}" class="text-center">
                                    <td> <i class="fa handle fa-sort" style="cursor: move" aria-hidden="true"></i></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Düzenle</a>
                                        <a href="" class="btn btn-danger btn-sm">Sil</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#createCategories').on('click', function() {
                    $.ajax({
                        url: '/category/func',
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            type: 'create-category'
                        },
                        success: function(data) {
                            $('#createCategory').find('.modal-body').html(data.data);
                            $('#createCategory').modal('show');
                        }
                    });
                });
                //insert-category

            });


            //categoryForm submit
            $(document).on('submit', '#categoryForm', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/category/func',
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        iziToast.success({
                            title: 'Başarılı',
                            message: data.message,
                            position: 'topRight'
                        });
                        $('#createCategory').modal('hide');
                    },
                    error: function(data) {
                        if (data.status == 422) {
                            $.each(data.responseJSON.errors, function(key, value) {
                                iziToast.error({
                                    title: 'Hata',
                                    message: value,
                                    position: 'topRight'
                                });
                            });
                        }
                    }
                });
            });


            //handle siralama sortable
            var el = document.getElementById('orders');
            $("#orders").sortable({
                handle: ".handle",
                update: function() {
                    var siralama = $("#orders").sortable("serialize");
                    var type = 'category-sort'
                    $.ajax({
                        url: '/category/func',
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            type: type,
                            siralama: siralama
                        },
                        success: function(data) {
                            iziToast.success({
                                title: 'Başarılı',
                                message: data.message,
                                position: 'topRight'
                            });
                        }
                    });
                }
            });
        </script>
    @endsection
</x-app-layout>
