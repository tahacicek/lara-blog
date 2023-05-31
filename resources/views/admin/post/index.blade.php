<x-app-layout>
    @section('title', 'Kategori')
    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    @endsection
    <div class="main-wrapper" id="main">
        <div class="main-wrapper">
            <h3 class="text-white">Kategoriler</h3>
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
                    <table class="table table-bordered table-striped" id="categoryTable">
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
                                    <td> {{ $post->image }} </td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->is_published }}</td>
                                    <td>
                                        <button data-id="{{ $post->id }}"
                                            class="btn btn-primary btn-sm editPost">Düzenle</button>
                                        <button data-id="{{ $post->id }}"
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
    @endsection
</x-app-layout>
