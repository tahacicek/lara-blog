<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Category Slug</th>
                <th>Category Created At</th>
                <th>Category Updated At</th>
                <th>Category Deleted At</th>
                <th>Category Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr id="category_{{ $category->id }}">
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <button data-id="{{ $category->id }}" class="btn btn-primary btn-sm coverCategory">Kurtar</button>
                        <button data-id="{{ $category->id }}" class="btn btn-danger btn-sm trashCategory">Sil</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
