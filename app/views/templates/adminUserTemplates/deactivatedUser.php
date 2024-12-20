<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8">
    <div class=" p-6">
        <h2 class="text-2xl font-bold text-gray-900">Deactivated Users</h2>
        <p class="mt-2 text-sm text-gray-500">Manage users who have been deactivated from the quiz platform.</p>
    </div>
    <table id="deactivatedUser" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-orange-500">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Date created
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($deactivateUser as $user): ?>
                <tr class="border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <?php echo $user['username'] ?>
                    </th>
                    <td class="px-6 py-4">
                        <?php echo $user['email'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php

                        $date = date_create($user['created_at']);
                        echo date_format($date, "F j, Y");

                        ?>
                    </td>


                    <td class="px-6 py-4 space-x-2">
                        <a href="<?= site_url('admin/users/activate/' . $user['id']) ?>" class="font-medium bg-green-100 rounded-full px-3 py-1 text-green-600 hover:bg-green-200 hover:text-green-600 transition-all ease-in-out">Activate</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<!-- Include DataTables JavaScript and CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#deactivatedUser').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "Search Users:",
                lengthMenu: "Show _MENU_ entries per page",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                },
                emptyTable: ` <div class="flex flex-col items-center justify-center py-12">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-base font-semibold">No deactivated user</p>
                            <p class="mt-1 text-sm text-gray-500">There is no deactivated user found.</p>
                        </div>`
            },
            // Tailwind-based Styling Overrides
            initComplete: function() {
                $('#deactivatedUser_filter input').addClass('w-64 ms-2 border px-2 outline-none ');
                $('#deactivatedUser_filter label').addClass('font-medium ');

                $('#deactivatedUser_length select').addClass('px-2 mx-2');

                $('#deactivatedUser_info').addClass('px-4 py-3')
                $('#deactivatedUser_paginate').addClass('px-4 py-2')

                $('#deactivatedUser th').addClass('px-4 border-b border-gray-200 py-2')
                $('#deactivatedUser td').addClass('border-b border-gray-200 py-2')
            },
            dom: '<"flex justify-between items-center px-4 py-2"lf>tip',
        });
    });
</script>