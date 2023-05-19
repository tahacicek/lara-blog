<x-app-layout>
    @section('title', 'Kategori')
    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                        <button class="btn btn-warning text-dark" id="recycleButton"> Geri Dönüşüm <i
                                class="fa fa-trash" aria-hidden="true"></i> </button>
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
                                <tr id="category_{{ $category->id }}" class="text-center">
                                    <td> <i class="fa handle fa-sort" style="cursor: move" aria-hidden="true"></i></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <button data-id="{{ $category->id }}"
                                            class="btn btn-primary btn-sm editCategory">Düzenle</button>
                                        <button data-id="{{ $category->id }}"
                                            class="btn btn-danger btn-sm deleteCategory">Sil</button>
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
        <script src="http://SortableJS.github.io/Sortable/Sortable.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
            integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
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

            //datatable
            $(document).ready(function() {
                $('#categoryTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Turkish.json"
                    },
                    "order": [
                        [0, "desc"]
                    ],
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "pageLength": 5,
                    //theme
                    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                    "buttons": [{
                            extend: 'copy',
                            text: '<i class="fas fa-copy"></i>',
                            className: 'btn btn-secondary btn-sm'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel"></i>',
                            className: 'btn btn-secondary btn-sm'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf"></i>',
                            className: 'btn btn-secondary btn-sm'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            className: 'btn btn-secondary btn-sm'
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="fas fa-columns"></i>',
                            className: 'btn btn-secondary btn-sm'
                        },
                    ]
                });
            });
            //categoryTable
            $("#orders").sortable({
                handle: ".handle",
                update: function() {
                    var siralama = $("#orders").sortable("serialize");
                    $.get("{{ route('category.order') }}?" + siralama, function(data, status) {
                        iziToast.success({
                            title: 'Başarılı',
                            message: data.message,
                            position: 'topRight'
                        });
                    });
                }
            });

            //editCategory
            $(document).on('click', '.editCategory', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/category/func',
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: 'edit-category',
                        id: id
                    },
                    success: function(data) {
                        $('#createCategory').find('.modal-body').html(data.data);
                        $('#createCategory').modal('show');
                    }
                });
            });

            //deleteCategory withi izitoast questions
            $(document).on('click', '.deleteCategory', function() {
                var id = $(this).data('id');
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Geri dönüşüm kutusuna atmak istediğinize emin misin?',
                    position: 'center',
                    buttons: [
                        ['<button><b>SİL</b></button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                            $.ajax({
                                url: '/category/func',
                                method: "POST",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    type: 'delete-category',
                                    id: id
                                },
                                success: function(data) {
                                    iziToast.success({
                                        title: 'Başarılı',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                    $('#category_' + id).remove();
                                }
                            });
                        }, true],
                        ['<button>İPTAL</button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                        }],
                    ]
                });
            });
            $(document).on('click', '#recycleButton', function() {
                $.ajax({
                    url: '/category/func',
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: 'recycle-category'
                    },
                    success: function(data) {
                        //bir daha tıklandığında geri dönsün
                        $('#recycleButton').attr('id', 'recycleButton2');
                        $('#recycleButton2').html('<i class="fas fa-arrow-left me-1"></i> Geri Dön');
                        $('#recycleButton2').attr('class', 'btn btn-primary');
                        //recycleButton2 tıklandığında bir adım geri dönsün


                        $('#category_table').load('/category/table');
                        $('#categoryTable').DataTable().destroy();
                        $('#categoryTable').html(data.data);
                        $('#categoryTable').DataTable({
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Turkish.json"
                            },
                            "order": [
                                [0, "desc"]
                            ],
                            "responsive": true,
                            "autoWidth": false,
                            "lengthChange": false,
                            "pageLength": 5,
                            //theme
                            "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                            "buttons": [{
                                    extend: 'copy',
                                    text: '<i class="fas fa-copy"></i>',
                                    className: 'btn btn-secondary btn-sm'
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="fas fa-file-excel"></i>',
                                    className: 'btn btn-secondary btn-sm'
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="fas fa-file-pdf"></i>',
                                    className: 'btn btn-secondary btn-sm'
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fas fa-print"></i>',
                                    className: 'btn btn-secondary btn-sm'
                                },
                                {
                                    extend: 'colvis',
                                    text: '<i class="fas fa-columns"></i>',
                                    className: 'btn btn-secondary btn-sm'
                                },
                            ]
                        });
                    }
                });
            });

            //recycleButton2 tıklandığında sayfayı yenile
            $(document).on('click', '#recycleButton2', function() {
                location.reload();
            });

            //coverCategory tıklandığında kategori kurtarılsın izitoas soruyla
            $(document).on('click', '.coverCategory', function() {
                var id = $(this).data('id');
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Kategoriyi kurtarmak istediğinize emin misiniz?',
                    position: 'center',
                    buttons: [
                        ['<button><b>KURTAR</b></button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                            $.ajax({
                                url: '/category/func',
                                method: "POST",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    type: 'cover-category',
                                    id: id
                                },
                                success: function(data) {
                                    iziToast.success({
                                        title: 'Başarılı',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                    $('#category_' + id).remove();
                                }
                            });
                        }, true],
                        ['<button>İPTAL</button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                        }],
                    ]
                });
            });
            //trashCategory with izitoast questions
            $(document).on('click', '.trashCategory', function() {
                var id = $(this).data('id');
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Kategoriyi kalıcı olarak silmek istediğinize emin misiniz?',
                    position: 'center',
                    buttons: [
                        ['<button><b>AT</b></button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                            $.ajax({
                                url: '/category/func',
                                method: "POST",
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    type: 'trash-category',
                                    id: id
                                },
                                success: function(data) {
                                    iziToast.success({
                                        title: 'Başarılı',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                    $('#category_' + id).remove();
                                }
                            });
                        }, true],
                        ['<button>İPTAL</button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                        }],
                    ]
                });
            });
        </script>
    @endsection
</x-app-layout>
