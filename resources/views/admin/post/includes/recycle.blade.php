<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Yazı İsmi</th>
                <th>Yazı Görseli</th>
                <th>Yazı Kategorileri</th>
                <th>Silinme Tarihi</th>
                <th>Yazı İşlemleri</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td><img src="{{ asset($post->image) }}" width="170px" alt="{{ $post->title }}"></td>
                    <td>
                        @foreach ($postCat as $cat)
                            @if ($post->id == $cat->post_id)
                                {{ $cat->category->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $post->deleted_at }}</td>
                    <td>
                        <button data-id="{{ $post->id }}" class="btn btn-primary btn-sm coverPost">Kurtar</button>
                        <button data-id="{{ $post->id }}" class="btn btn-danger btn-sm trashPost">Sil</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
