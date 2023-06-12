<x-app-layout>
    @section('title', 'Yazılar')
    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    @endsection
    <div class="main-wrapper" id="main">
        <div class="main-wrapper">
            <h3 class="text-white">Yazılar</h3>
            <div class="py-3"></div>
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <a class="btn btn-success me-2"
                            href="{{ route('post.create') }}"> Oluştur <i class="fa fa-check" aria-hidden="true"></i></a>
                        <button class="btn btn-warning text-dark" id="recycleButton"> Geri Dönüşüm <i
                                class="fa fa-trash" aria-hidden="true"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="postTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Görsel</th>
                                <th>Post Adı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody id="orders">
                            @foreach ($posts as $post)
                                <tr class="text-center">
                                    <td> {{ $post->id }} </td>
                                    <td>  <img src="{{ asset($post->image) }}" alt="" width="150px"> </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->is_published }}</td>
                                    <td>
                                        <a href="{{ route('post.edit', $post->id) }}"
                                            class="btn btn-primary btn-sm editPost">Düzenle</a>
                                        <button data-id="{{ $post->id }}" data-title="{{ $post->title }}"
                                            class="btn btn-danger btn-sm deletePost">Sil</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        //if click delete post with izitoast questions ajax
        $('.deletePost').on('click', function() {
            let id = $(this).data('id');
            let title = $(this).data('title');
            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure want to delete ' + title + ' post?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {
                        $.ajax({
                            type: "POST",
                            url: "/post/func/",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                type: 'delete-post'
                            },
                            success: function(response) {
                                if (response.status == 200) {
                                    iziToast.success({
                                        title: 'OK',
                                        message: "Yazı başarıyla geri dönüşüm kutusuna atıldı.",
                                        position: 'topRight'
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                }
                            }
                        });
                    }, true],
                    ['<button>NO</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp'
                        }, toast, 'button');
                    }],
                ]
            });
        });

        $(document).on('click', '#recycleButton', function() {
                $.ajax({
                    url: '/post/func',
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: 'recycle-post'
                    },
                    success: function(data) {
                        //bir daha tıklandığında geri dönsün
                        $('#recycleButton').attr('id', 'recycleButton2');
                        $('#recycleButton2').html('<i class="fas fa-arrow-left me-1"></i> Geri Dön');
                        $('#recycleButton2').attr('class', 'btn btn-primary');
                        $('#post_table').load('/post/table');
                        $('#postTable').DataTable().destroy();
                        $('#postTable').html(data.data);
                        $('#postTable').DataTable({
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

    </script>
    @endsection

</x-app-layout>
