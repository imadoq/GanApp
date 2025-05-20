document.addEventListener('DOMContentLoaded', function () {
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');

    navItems.forEach(item => {
        item.addEventListener('click', function () {
            navItems.forEach(nav => nav.classList.remove('active'));
            tabContents.forEach(tab => tab.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    $(document).ready(function () {
        $('#event-table').DataTable({
            "searching": true,
            "lengthChange": false,
            "info": false,
            "paging": true
        });

        $('#user-table').DataTable({
            "searching": true,
            "lengthChange": false,
            "info": false,
            "paging": true
        });

        $("#event-search").on("keyup", function () {
            $("#event-table").DataTable().search($(this).val()).draw();
        });

        $("#user-search").on("keyup", function () {
            $("#user-table").DataTable().search($(this).val()).draw();
        });
    });
});
