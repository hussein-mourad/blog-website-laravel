@if (session()->has('success'))
    <div class="alert alert-success mb-4 alert-dismissible fade show" id="alertSuccess" role="alert"
        data-mdb-color="primary">
        <i class="fas fa-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close ms-2" data-mdb-dismiss="alert" aria-label="Close"
            onclick="removeAlert()"></button>
    </div>
    <script>
        function removeAlert() {
            let alert = document.querySelector("#alertSuccess");
            alert.remove()
        }
    </script>
@endif
