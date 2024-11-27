<div class=" relative overflow-x-auto shadow-md sm:rounded-lg bg-white mb-8 w-full">
    <div class=" p-6">
        <h2 class="text-2xl font-bold text-gray-900">Weekly Player Rankings</h2>
        <p class="mt-2 text-sm text-gray-500">List of all top players this week.</p>
    </div>
    <table id="weeklyPoints" class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-purple-500">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Rank
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Points
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($weeklyPlayers as $index => $points): ?>
                <tr class="border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <?php echo $index + 1 ?>
                    </th>
                    <td class="px-6 py-4">
                        <?php echo $points['name'] ?>
                    </td>

                    <td class="px-6 py-4">
                        <?php if ($points['points'] === null) {
                            echo $points['points'] = 0 . ' pts';
                        } else {
                            echo $points['points'] . ' pts';
                        }

                        ?>
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
        $('#weeklyPoints').DataTable({
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
                emptyTable: `   <div class="flex flex-col items-center justify-center py-12">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-base font-semibold">No player ranking</p>
                            <p class="mt-1 text-sm text-gray-500">There is no record of player's ranking.</p>
                        </div>`
            },
            // Tailwind-based Styling Overrides
            initComplete: function() {
                $('#weeklyPoints_filter input').addClass('w-64 ms-2 border px-2 outline-none ');
                $('#weeklyPoints_filter label').addClass('font-medium ');

                $('#weeklyPoints_length select').addClass('px-2 mx-2');

                $('#weeklyPoints_info').addClass('px-4 py-3')
                $('#weeklyPoints_paginate').addClass('px-4 py-2')

                $('#weeklyPoints th').addClass('px-4 border-b border-gray-200 py-2')
                $('#weeklyPoints td').addClass('border-b border-gray-200 py-2')
            },
            dom: '<"flex justify-between items-center px-4 py-2"lf>tip',
        });
    });
</script>