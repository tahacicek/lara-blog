<form id="categoryForm">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control form-control-sm" name="name" id="name">
        <label for="name">Kategori Adı</label>
    </div>
    <div class="form-group mb-3">
        <textarea class="form-control" id="description" rows="5" name="description" placeholder="Kategori Açıklaması"></textarea>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control form-control-sm" name="meta_title" id="meta_title">
        <label for="meta_title">Meta Başlık</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control form-control-sm" id="meta_description" name="meta_description">
        <label for="meta_description">Meta Açıklaması</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control form-control-sm" id="meta_keywords" name="meta_keywords">
        <label for="meta_keywords">Meta Anahtar Kelimeler</label>
    </div>
    <select class="form-select" name="status" aria-label="Default select example">
        <option selected value="active">Aktif</option>
        <option value="passive">Pasif</option>
    </select>
    @if ($type == 'create-category')
        <input type="hidden" name="type" value="insert-category">
    @else
        <input type="hidden" name="type" value="update-category">
        <input type="hidden" name="id" value="{{ $category->id }}">
    @endif
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        @if ($type == 'create-category')
            <button type="submit" class="btn btn-primary insertCategory">Oluştur</button>
        @else
            <button type="submit" class="btn btn-primary updateCategory">Güncelle</button>
        @endif
    </div>
</form>
