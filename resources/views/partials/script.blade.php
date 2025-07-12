{{-- Script AlpineJS --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Script sidebar responsive -->
<script>
    let collapsed = false;

    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const toggleIcon = document.getElementById("toggleIcon");
        const labels = document.querySelectorAll(".sidebar-label");
        const title = document.getElementById("sidebarTitle");

        collapsed = !collapsed;

        const mainContent = document.querySelector(".main-content-wrapper"); // tambahkan class ini ke div pembungkus konten

if (collapsed) {
    sidebar.classList.remove("w-64");
            sidebar.classList.add("w-20");
            toggleIcon.textContent = "»";
            labels.forEach((label) => label.classList.add("hidden"));
            title.classList.add("hidden");
            mainContent.classList.add("ml-20");
            mainContent.classList.remove("ml-64");
        } else {
            sidebar.classList.remove("w-20");
            sidebar.classList.add("w-64");
            toggleIcon.textContent = "«";
            labels.forEach((label) => label.classList.remove("hidden"));
            title.classList.remove("hidden");
            mainContent.classList.add("ml-64");
            mainContent.classList.remove("ml-20");
        }
    }

    function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
            document.getElementById("logoutForm").submit();
        }
    }

    // Highlight menu when clicked
    document.querySelectorAll("#sidebar nav ul li a").forEach((link) => {
        link.addEventListener("click", function () {
            document
                .querySelectorAll("#sidebar nav ul li a")
                .forEach((item) => {
                    item.classList.remove("bg-green-600", "text-white");
                });
            this.classList.add("bg-green-600", "text-white");
        });
    });
</script>

 {{-- DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    {{-- Nomor Telepon --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tlpInput = document.getElementById("tlp");

            tlpInput.addEventListener("input", function () {
                if (!tlpInput.value.startsWith("62")) {
                    tlpInput.value = "62";
                }
            });

            tlpInput.addEventListener("focus", function () {
                if (tlpInput.value.trim() === "") {
                    tlpInput.value = "62";
                }
            });
        });
    </script>

{{-- Sweetalert2 --}}
{{-- Login --}}
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>
@stack('scripts')


{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
