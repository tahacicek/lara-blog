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
                        <button data-bs-toggle="modal" data-bs-target="#createCategory" class="btn btn-success me-2"> Oluştur <i class="fa fa-check" aria-hidden="true"></i></button>
                        <button class="btn btn-warning text-dark"> Geri Dönüşüm <i class="fa fa-trash" aria-hidden="true"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    asdasd
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    @section('js')
    @endsection
</x-app-layout>
