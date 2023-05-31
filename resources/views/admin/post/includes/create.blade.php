<x-app-layout>
    @section('title', 'Kategori')
    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }

            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
        </style>
    @endsection
    <div class="main-wrapper">
        <h3 class="text-white">Kategoriler</h3>
        <div class="py-3"></div>
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="{{ route('post') }}" class="btn btn-success me-2"
                        id="createCategories"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri</a>
                    {{-- <button class="btn btn-warning text-dark" id="recycleButton"> Geri Dönüşüm <i class="fa fa-trash"
                            aria-hidden="true"></i> </button> --}}
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('post.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Post Başlığı</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Post İçeriği</label>
                        <textarea name="content" id="editor"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select name="category[]" class="form-control" id='category' multiple="multiple">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Etiket</label>
                        <select name="tags[]" class="form-control" id='tags' multiple="multiple"></select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Post Kapak Görseli</label>
                        <input name="image" class="form-control" type="file" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Başlığı</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title">
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Açıklaması</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description">
                    </div>
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published">
                        <label class="form-check-label" for="is_published">
                            Şimdi Yayınlansın
                        </label>
                    </div>
                    <div class="mb-3" id="publishDate">
                        <label for="exampleInputEmail1" class="form-label">Yayın Tarihi</label>
                        <input class="form-control col-md-2" type="date" name="published_at" placeholder="dd-mm-yyyy"
                            value="" min="1997-01-01" max="2030-12-31">
                    </div>
                    <div class="mb-3 float-end">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
            integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });


            $("#tags").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
            $("#category").select2({
                tokenSeparators: [',', ' '],
            })

            //is_published chekced publishDate hidden
            $("#is_published").click(function() {
                if ($(this).is(":checked")) {
                    $("#publishDate").hide(200);
                } else {
                    $("#publishDate").show(200);
                }
            });
        </script>
    @endsection
</x-app-layout>
