<x-app-layout>
    <x-slot name="title">
        Edit Category
    </x-slot>
    <body>
    <div class="content">
        <div class="container">
            <h1 class="my-md-5 my-4">{{ $category->name }}</h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <form method="POST" action="{{ route('editCategory', $category) }}">
                        @csrf
                        @method('post')
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control" placeholder="Напишите название" id="floatingName" required>
                            <label for="floatingName">Новое название</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <button class="btn btn-warning" type="submit">Редактировать</button>
                    </form>
                </div>
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
