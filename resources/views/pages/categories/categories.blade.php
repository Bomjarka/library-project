<x-app-layout>
    <x-slot name="title">
        Categories
    </x-slot>
    <body>
    <div class="container">
        <h1 class="my-md-5 my-4">Категории</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <h1 class="text-danger">{{ $error }}</h1>
            @endforeach
        @endif
        <a class="btn btn-primary mb-4" href="{{ route('newCategory') }}" role="button">Добавить</a>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Название</strong>
                    </li>
                    @foreach($categories as $category)
                        <div class="category-div" id="{{ $category->id }}">
                            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span class="me-3">
                                {{ $category->name }}
                            </span>
                                <span class="text-nowrap">
                            <a href="{{ route('viewCategory', $category) }}" class="text-decoration-none me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                            </a>
                        <a id="{{ $category->id }}" href="#exampleModalToggle"
                           class="delete-button text-decoration-none" data-bs-toggle="modal" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                        </span>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    </body>
</x-app-layout>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Удаление категории</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    Вы уверены, что хотите удалить эту категорию?
                </div>
            </div>
            <div class="modal-footer">
                <input class="category-id-post" type="hidden" value="">
                <button type="submit" class="delete-category-button btn btn-danger">Да</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete-button').on('click', function () {
        let categoryId = $(this).attr('id');
        $('.category-id-post').val(categoryId);

        $('.delete-category-button').on('click', function () {
            let url = "{{ route('deleteCategory', ':id') }}";
            url = url.replace(':id', categoryId)
            $.post(url, {
                _token: '{{ csrf_token() }}',
            }).done(function (response) {
                console.log(response)
                if(response.msg == 'success') {
                    window.location.reload();
                }

                console.log(response.msg);
            });
        });

    });
</script>
