<x-app-layout>
    <x-slot name="title">
        Types
    </x-slot>
    <body>
    <div class="container">
        <h1 class="my-md-5 my-4">Типы</h1>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Название</strong>
                    </li>
                    @foreach($types as $type)
                        <li class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span class="me-3">
                                {{ $type->name }}
                            </span>
                        </li>
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
